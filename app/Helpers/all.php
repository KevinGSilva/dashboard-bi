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

    if (!function_exists('getNotes')) {

        function getNotes($search = null)
        {
            $list = [
                0 => 'C',
                1 => 'C#',
                2 => 'D',
                3 => 'D#',
                4 => 'E',
                5 => 'F',
                6 => 'F#',
                7 => 'G',
                8 => 'G#',
                9 => 'A',
                10 => 'A#',
                11 => 'B',
            ];
    
            if (is_null($search)) {
                return $list;
            }
    
            if (!isset($list[$search])) {
                throw new Exception('A nota ' . $search . ' não é válida');
            }
    
            return $list[$search];
        }
    }
    
    if (!function_exists('getTimeSignature')) {

        function getTimeSignature($search = null)
        {
            $list = [
                0 => '0/4',
                1 => '1/4',
                2 => '2/4',
                3 => '3/4',
                4 => '4/4',
                5 => '5/4',
                6 => '6/4',
                7 => '7/4',
            ];
    
            if (is_null($search)) {
                return $list;
            }
    
            if (!isset($list[$search])) {
                throw new Exception('A nota ' . $search . ' não é válida');
            }
    
            return $list[$search];
        }
    }