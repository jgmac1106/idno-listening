<?php

    namespace IdnoPlugins\Listening {

        class Main extends \Idno\Common\Plugin {

            function registerPages() {
                \Idno\Core\site()->addPageHandler('/listening/edit/?', '\IdnoPlugins\Listening\Pages\Edit');
                \Idno\Core\site()->addPageHandler('/listening/edit/([A-Za-z0-9]+)/?', '\IdnoPlugins\Listening\Pages\Edit');
                \Idno\Core\site()->addPageHandler('/listening/delete/([A-Za-z0-9]+)/?', '\IdnoPlugins\Listening\Pages\Delete');
                \Idno\Core\site()->addPageHandler('/listening/([A-Za-z0-9]+)/.*', '\Idno\Pages\Entity\View');
                
                \Idno\Core\site()->addPageHandler('/listening/webhook/', '\IdnoPlugins\Listening\Pages\Endpoint', true);
            }

            /**
             * Get the total file usage
             * @param bool $user
             * @return int
             */
            function getFileUsage($user = false) {

                $total = 0;

                if (!empty($user)) {
                    $search = ['user' => $user];
                } else {
                    $search = [];
                }

                if ($listenings = listening::get($search,[],9999,0)) {
                    foreach($listenings as $listening) {
                        if ($listening instanceof listening) {
                            if ($attachments = $watching->getAttachments()) {
                                foreach($attachments as $attachment) {
                                    $total += $attachment['length'];
                                }
                            }
                        }
                    }
                }

                return $total;
            }

        }

    }
