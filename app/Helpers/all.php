<?php
    if (!function_exists('getEntity')) {

        function getEntity($search = null)
        {
            $list = [
                0 => 'track',
                1 => 'artist',
                2 => 'album',
            ];
    
            if (is_null($search)) {
                return $list;
            }
    
            if (!isset($list[$search])) {
                throw new Exception('A entidade ' . $search . ' não é válida');
            }
    
            return $list[$search];
        }
    }

    if (!function_exists('getEntityTranslated')) {

        function getEntityTranslated($search = null)
        {
            $list = [
                0 => 'Música',
                1 => 'Artista',
                2 => 'Álbum',
            ];
    
            if (is_null($search)) {
                return $list;
            }
    
            if (!isset($list[$search])) {
                throw new Exception('A entidade ' . $search . ' não é válida');
            }
    
            return $list[$search];
        }
    }