<?php

class Importer
{
    /**
     * @var string
     */
    private $Records;

    public function __construct(string $json)
    {
        $this->Records = json_decode($json, true);
    }

    public function GetRows()
    {
        return $this->Records['rows'];
    }

    public function Import()
    {
        //$tablename = $this->GetTableName();

        //echo 'Импорт таблицы ' . $tablename . '<br>';

        $StartTime = microtime(true);
        $this->ImportArticles();
        echo '<br><br>',"Выполнено за: ".(microtime(true)-$StartTime)." сек.", '<br>';
    }

    public function GetTableName(): string
    {
        return $this->Records['table'];
    }

    private function ImportSections()
    {
        foreach ($this->Records['rows'] as $row) {
            if (get_term_by('name', $row['title']) === false) {
                wp_insert_term($row['title'], 'section', ['term_id' => $row['doc_thema_id']]);
            }
        }
    }

    private function ImportMagazines()
    {
        $recCount = 0;
        foreach ($this->Records['rows'] as $row) {
            $user = wp_get_current_user();
            $month = $this->GetTextMonthName($row['nomer_month1']);
            $title = "№{$row['nomer_local']} ({$row['nomer_id']}) - {$month} {$row['nomer_year']}";
            // вставляем запись в базу данных
            $post_id = wp_insert_post(wp_slash([
                //'post_status'   => 'draft',
                'post_type' => 'magazine',
                'post_author' => $user->ID,
                'post_content' => $row['nomer_anonce'],
                'post_title' => $title,
                'post_status' => 'publish'
                //'post_date' => $row['add_date']
            ]));

            add_post_meta($post_id, 'common_number', $row['nomer_id']);
            add_post_meta($post_id, 'current_number', $row['nomer_local']);
            add_post_meta($post_id, 'release_date_from', "{$row['nomer_date1']}.{$row['nomer_month1']}.{$row['nomer_year']}");
            add_post_meta($post_id, 'release_date_to', "{$row['nomer_date2']}.{$row['nomer_month2']}.{$row['nomer_year']}");

            $recCount++;
        }

        echo 'Импортировано ' . $recCount . ' журналов';
    }

    private function GetTextMonthName($monthDigit): string
    {
        $monthText = '';

        $monthDigit = (string)trim($monthDigit);
        switch ($monthDigit) {
            case "1":
                $monthText = 'Январь';
                break;
            case "2":
                $monthText = 'Февраль';
                break;
            case "3":
                $monthText = 'Март';
                break;
            case "4":
                $monthText = 'Апрель';
                break;
            case "5":
                $monthText = 'Май';
                break;
            case "6":
                $monthText = 'Июнь';
                break;
            case "7":
                $monthText = 'Июль';
                break;
            case "8":
                $monthText = 'Август';
                break;
            case "9":
                $monthText = 'Сентябрь';
                break;
            case "10":
                $monthText = 'Октябрь';
                break;
            case "11":
                $monthText = 'Ноябрь';
                break;
            case "12":
                $monthText = 'Декабрь';
                break;
        }

        return $monthText;
    }

    private function ImportArticles()
    {
        //$memLimit = ini_get('memory_limit');
        try {
            $recCount = 0;

            $queryArgs = [
                'posts_per_page' => -1,
                'post_type' => 'magazine'
            ];
            $allMagazines = Timber\Timber::get_posts($queryArgs);

            $args = [
                'taxonomy' => 'section',
                'numberposts' => -1,
            ];
            $allSections = Timber\Timber::get_terms($args);

            $FuncFindIdByNomId = function ($nomId) use ($allMagazines) {
                foreach ($allMagazines as $magazine) {
                    if ((int)$magazine->custom['common_number'] === (int)$nomId) {
                        return $magazine->ID;
                    }
                }

                return 0;
            };

            $FuncFindIdBySectId = function ($sectId) use ($allSections) {
                foreach ($allSections as $section) {
                    if ((int)$section->meta('old_term_id') === (int)$sectId) {
                        return $section->ID;
                    }
                }

                return 0;
            };

            $user = wp_get_current_user();
            global $wpdb;

            if ($user !== null) {
                foreach ($this->Records['rows'] as $row) {
                    $old_link = '/read/' . $row['doc_id'] . '.html';

                    $result = $wpdb->get_row(
                            $wpdb->prepare(
                        "SELECT * FROM wp_posts WHERE ((post_title = %s) and (post_content = %s))", $row['title'],  $row['document'])
                    );
                    $foundArticle = ($result !== null);

                    if ($foundArticle === false)
                    {
                        $magazine_id = $FuncFindIdByNomId($row['nomer_id']);
                        if($magazine_id == 0)
                            continue;

                        // вставляем запись в базу данных
                        $post_id = wp_insert_post(wp_slash([
                            //'post_status'   => 'draft',
                            'post_date' => $row['add_date'],
                            'post_modified' => $row['update_date'],
                            'post_type' => 'article',
                            'post_author' => $user->ID,
                            'post_content' => $row['document'],
                            'post_title' => $row['title'],
                            'post_status' => 'publish'
                        ]));

                        if (trim($row['other_rights']) !== 'r') {
                            add_post_meta($post_id, 'art_only_for_registered', '1');
                        }

                        $terms = [];
                        $newSectId = null;
                        if (!empty($row['doc_thema_id1']) && ((int)$row['doc_thema_id1'] != 0)) {
                            $newSectId = $FuncFindIdBySectId($row['doc_thema_id1']);
                            if (!empty($newSectId)) {
                                array_push($terms, (int)$newSectId);
                            }
                            //array_push( $terms, (int) $row['doc_thema_id1'] );
                        }
                        if (!empty($row['doc_thema_id2']) && ((int)$row['doc_thema_id2'] != 0)) {
                            $newSectId = $FuncFindIdBySectId($row['doc_thema_id2']);
                            if (!empty($newSectId)) {
                                array_push($terms, (int)$newSectId);
                            }
                            //array_push( $terms, (int) $row['doc_thema_id2'] );
                        }
                        if (!empty($row['doc_thema_id3']) && ((int)$row['doc_thema_id3'] != 0)) {
                            $newSectId = $FuncFindIdBySectId($row['doc_thema_id3']);
                            if (!empty($newSectId)) {
                                array_push($terms, (int)$newSectId);
                            }
                            //array_push( $terms, (int) $row['doc_thema_id3'] );
                        }
                        if (!empty($row['doc_thema_id4']) && ((int)$row['doc_thema_id4'] != 0)) {
                            $newSectId = $FuncFindIdBySectId($row['doc_thema_id4']);
                            if (!empty($newSectId)) {
                                array_push($terms, (int)$newSectId);
                            }
                            //array_push( $terms, (int) $row['doc_thema_id4'] );
                        }
                        if (!empty($row['doc_thema_id5']) && ((int)$row['doc_thema_id5'] != 0)) {
                            $newSectId = $FuncFindIdBySectId($row['doc_thema_id5']);
                            if (!empty($newSectId)) {
                                array_push($terms, (int)$newSectId);
                            }
                            //array_push( $terms, (int) $row['doc_thema_id5'] );
                        }
                        if (count($terms) > 0)
                            wp_set_post_terms($post_id, $terms, 'section');


                        //$magazine_id = $FuncFindIdByNomId($row['nomer_id']);
                        if ($magazine_id != 0) {
                            update_post_meta($post_id, 'art_links', [0 => $magazine_id]);
                        }
                        add_post_meta($post_id, 'art_date', $row['add_date']);
                        add_post_meta($post_id, 'old_link', '/read/' . $row['doc_id'] . '.html');
                        add_post_meta($post_id, 'art_priority', $row['prioritet']);


                        $recCount++;

                        if ($recCount % 1000 == 0) {
                            sleep(1);
                        }
                    }

                }

                echo 'Импортировано ' . $recCount . ' статей';
            }
        } catch (Throwable $t) {
            print_r($t);
        }
    }

    private function ImportSections2()
    {
        $args = [
            'post_type' => 'article',
            'post_status' => 'publish',
            'numberposts' => -1,
        ];
        $articles = (new \Timber\PostQuery($args))->get_posts();

        $terms = get_terms([
            'taxonomy' => 'section',
            'hide_empty' => false,
        ]);
        $arrTerms = [];
        foreach ($terms as $term) {
            $meta = get_term_meta($term->term_id, 'old_term_id');
            if (isset($meta[0])) {
                $arrTerms[$meta[0]] = $term->term_id;
            }
        }

        foreach ($articles as $article) {
            //wp_delete_object_term_relationships( $article->ID, 'section' );
            if (isset($article->custom['old_link'])) {
                $found = [];
                if (preg_match_all("|\/read\/(.*)\.html|", $article->custom['old_link'], $found) != 0) {
                    //wp_delete_object_term_relationships( $article->ID, 'section' );

                    foreach ($this->Records['rows'] as $row) {
                        if ($row['doc_id'] == $found[1][0]) {
                            $terms = [];
                            if (!empty($row['doc_thema_id1']) && ((int)$row['doc_thema_id1'] != 0)) {
                                array_push($terms, (int)$arrTerms[$row['doc_thema_id1']]);
                            }
                            if (!empty($row['doc_thema_id2']) && ((int)$row['doc_thema_id2'] != 0)) {
                                array_push($terms, (int)$arrTerms[$row['doc_thema_id2']]);
                            }
                            if (!empty($row['doc_thema_id3']) && ((int)$row['doc_thema_id3'] != 0)) {
                                array_push($terms, (int)$arrTerms[$row['doc_thema_id3']]);
                            }
                            if (!empty($row['doc_thema_id4']) && ((int)$row['doc_thema_id4'] != 0)) {
                                array_push($terms, (int)$arrTerms[$row['doc_thema_id4']]);
                            }
                            if (!empty($row['doc_thema_id5']) && ((int)$row['doc_thema_id5'] != 0)) {
                                array_push($terms, (int)$arrTerms[$row['doc_thema_id5']]);
                            }
                            wp_set_post_terms($article->ID, $terms, 'section');
                            break;
                        }
                    }
                }
            }
        }
    }

    private function CorrectDates()
    {
        $args = [
            'post_type' => 'article',
            'post_status' => 'publish',
            'numberposts' => -1,
        ];
        $articles = (new \Timber\PostQuery($args))->get_posts();

        foreach ($articles as $article) {
            if (isset($article->custom['old_link'])) {
                if (preg_match_all("|\/read\/(.*)\.html|", $article->custom['old_link'], $found) != 0) {
                    //wp_delete_object_term_relationships( $article->ID, 'section' );

                    foreach ($this->Records['rows'] as $row) {
                        if ($row['doc_id'] == $found[1][0]) {
                            $args = array(
                                'ID' => $article->ID,
                                'post_date' => $row['add_date'],
                                'post_content' => $row['document']
                            );
                            wp_update_post($args);
                            usleep(300);
                        }
                    }
                }
            }
        }
    }
}