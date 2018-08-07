<?php

class functions
{

    public $currency_info = array(
        array('code' => 'AED', 'name' => 'United Arab Emirates Dirham'),
        array('code' => 'ANG', 'name' => 'NL Antillian Guilder'),
        array('code' => 'ARS', 'name' => 'Argentine Peso'),
        array('code' => 'AUD', 'name' => 'Australian Dollar'),
        array('code' => 'BRL', 'name' => 'Brazilian Real'),
        array('code' => 'BSD', 'name' => 'Bahamian Dollar'),
        array('code' => 'CAD', 'name' => 'Canadian Dollar'),
        array('code' => 'CHF', 'name' => 'Swiss Franc'),
        array('code' => 'CLP', 'name' => 'Chilean Peso'),
        array('code' => 'CNY', 'name' => 'Chinese Yuan Renminbi'),
        array('code' => 'COP', 'name' => 'Colombian Peso'),
        array('code' => 'CZK', 'name' => 'Czech Koruna'),
        array('code' => 'DKK', 'name' => 'Danish Krone'),
        array('code' => 'EUR', 'name' => 'Euro'),
        array('code' => 'FJD', 'name' => 'Fiji Dollar'),
        array('code' => 'GBP', 'name' => 'British Pound'),
        array('code' => 'GHS', 'name' => 'Ghanaian New Cedi'),
        array('code' => 'GTQ', 'name' => 'Guatemalan Quetzal'),
        array('code' => 'HKD', 'name' => 'Hong Kong Dollar'),
        array('code' => 'HNL', 'name' => 'Honduran Lempira'),
        array('code' => 'HRK', 'name' => 'Croatian Kuna'),
        array('code' => 'HUF', 'name' => 'Hungarian Forint'),
        array('code' => 'IDR', 'name' => 'Indonesian Rupiah'),
        array('code' => 'ILS', 'name' => 'Israeli New Shekel'),
        array('code' => 'INR', 'name' => 'Indian Rupee'),
        array('code' => 'ISK', 'name' => 'Iceland Krona'),
        array('code' => 'JMD', 'name' => 'Jamaican Dollar'),
        array('code' => 'JPY', 'name' => 'Japanese Yen'),
        array('code' => 'KRW', 'name' => 'South-Korean Won'),
        array('code' => 'LKR', 'name' => 'Sri Lanka Rupee'),
        array('code' => 'MAD', 'name' => 'Moroccan Dirham'),
        array('code' => 'MMK', 'name' => 'Myanmar Kyat'),
        array('code' => 'MXN', 'name' => 'Mexican Peso'),
        array('code' => 'MYR', 'name' => 'Malaysian Ringgit'),
        array('code' => 'NOK', 'name' => 'Norwegian Kroner'),
        array('code' => 'NZD', 'name' => 'New Zealand Dollar'),
        array('code' => 'PAB', 'name' => 'Panamanian Balboa'),
        array('code' => 'PEN', 'name' => 'Peruvian Nuevo Sol'),
        array('code' => 'PHP', 'name' => 'Philippine Peso'),
        array('code' => 'PKR', 'name' => 'Pakistan Rupee'),
        array('code' => 'PLN', 'name' => 'Polish Zloty'),
        array('code' => 'RON', 'name' => 'Romanian New Lei'),
        array('code' => 'RSD', 'name' => 'Serbian Dinar'),
        array('code' => 'RUB', 'name' => 'Russian Rouble'),
        array('code' => 'SEK', 'name' => 'Swedish Krona'),
        array('code' => 'SGD', 'name' => 'Singapore Dollar'),
        array('code' => 'THB', 'name' => 'Thai Baht'),
        array('code' => 'TND', 'name' => 'Tunisian Dinar'),
        array('code' => 'TRY', 'name' => 'Turkish Lira'),
        array('code' => 'TTD', 'name' => 'Trinidad/Tobago Dollar'),
        array('code' => 'TWD', 'name' => 'Taiwan Dollar'),
        array('code' => 'USD', 'name' => 'US Dollar'),
        array('code' => 'VEF', 'name' => 'Venezuelan Bolivar Fuerte'),
        array('code' => 'VND', 'name' => 'Vietnamese Dong'),
        array('code' => 'XAF', 'name' => 'CFA Franc BEAC'),
        array('code' => 'XCD', 'name' => 'East Caribbean Dollar'),
        array('code' => 'XPF', 'name' => 'CFP Franc'),
        array('code' => 'ZAR', 'name' => 'South African Rand')
    );


    function get_random_string($valid_chars, $length)
    {
        // start with an empty random string
        $random_string = "";

        // count the number of chars in the valid chars string so we know how many choices we have
        $num_valid_chars = strlen($valid_chars);

        // repeat the steps until we've created a string of the right length
        for ($i = 0; $i < $length; $i++) {
            // pick a random number from 1 up to the number of valid chars
            $random_pick = mt_rand(1, $num_valid_chars);

            // take the random character out of the string of valid chars
            // subtract 1 from $random_pick because strings are indexed starting at 0, and we started picking at 1
            $random_char = $valid_chars[$random_pick - 1];

            // add the randomly-chosen char onto the end of our string so far
            $random_string .= $random_char;
        }

        // return our finished random string
        return $random_string;
    }

    function sanitize($string)
    {
        // check string value
        $string = mysql_escape_string(trim(strip_tags(stripslashes($string))));
        return $string;
    }

    function check_integer($which)
    {
        if (isset($_GET[$which])) {
            if (intval($_GET[$which]) > 0) {
                return intval($_GET[$which]);
            } else {
                return false;
            }
        }
        return false;
    }

    function get_current_page()
    {
        if (($var = $this->check_integer('page'))) {
            //return value of 'page', in support to above method
            return $var;
        } else {
            //return 1, if it wasnt set before, page=1
            return 1;
        }
    }

    function doPages($page_size, $thepage, $query_string, $total = 0, $keyword)
    {
        //per page count
        $index_limit = 10;

        //set the query string to blank, then later attach it with $query_string
        $query = '';

        if (strlen($query_string) > 0) {
            $query = "&amp;" . $query_string;
        }

        //get the current page number example: 3, 4 etc: see above method description
        $current = $this->get_current_page();

        $total_pages = ceil($total / $page_size);
        $start = max($current - intval($index_limit / 2), 1);
        $end = $start + $index_limit - 1;

        echo '<div id="page_num">';
        echo '<ul class="pagination">';

        if ($current == 1) {
            echo '';
        } else {
            $i = $current - 1;
            echo '<li><a href="' . $thepage . '?page=' . $i . $query . '&keyword=' . $keyword . '" rel="nofollow" title="go to page ' . $i . '">&laquo;</a></li>';
            //echo '<p>...</p>&nbsp;';
        }
        //<button>'.$i.'</button>
        if ($start > 1) {
            $i = 1;
            echo '<li><a href="' . $thepage . '?page=' . $i . $query . '&keyword=' . $keyword . '" title="go to page ' . $i . '">' . $i . '</a></li>';
        }

        for ($i = $start; $i <= $end && $i <= $total_pages; $i++) {
            if ($i == $current) {
                echo '<li class="active"><a>' . $i . '</a></li>';
            } else {
                echo '<li><a href="' . $thepage . '?page=' . $i . $query . '&keyword=' . $keyword . '" title="go to page ' . $i . '">' . $i . '</a></li>';
            }
        }

        if ($total_pages > $end) {
            $i = $total_pages;
            echo '<li><a href="' . $thepage . '?page=' . $i . $query . '&keyword=' . $keyword . '" title="go to page ' . $i . '">' . $i . '</a></li>';
        }

        if ($current < $total_pages) {
            $i = $current + 1;
            //echo '<p>...</p>&nbsp;';
            echo '<li><a href="' . $thepage . '?page=' . $i . $query . '&keyword=' . $keyword . '" rel="nofollow" title="go to page ' . $i . '">&raquo;</a></li>';
        } else {
            echo '';
        }

        echo '</ul>';

        //if nothing passed to method or zero, then dont print result, else print the total count below:
        if ($total != 0) {
            //prints the total result count just below the paging
            echo '<p><br>( total ' . $total . ' )</p></div>';
        } else {
            echo '</div>';
        };

    }

    /* Mascara para esses dados abaixo
     * echo mask($cnpj,'##.###.###/####-##');
     * echo mask($cpf,'###.###.###-##');
     * echo mask($cep,'#####-###');
     * echo mask($data,'##/##/####');
     */
    function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset($val[$k]))
                    $maskared .= $val[$k++];
            } else {
                if (isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }

    /*Esconder numeros iniciais do cpf*/
    function hideCpf($cpf)
    {
        return "***.***" . substr($cpf, -7);
    }

    /*remover caracteres como . e -*/
    function removerCarctEspecCpf($valor)
    {
        $pontos = array(".", "-");
        $result = str_replace($pontos, "", $valor);
        return $result;
    }

    /*limpar string com caracteres especiais*/
    function limparString($str)
    {
        $str = preg_replace('/[áàãâä]/ui', 'a', $str);
        $str = preg_replace('/[éèêë]/ui', 'e', $str);
        $str = preg_replace('/[íìîï]/ui', 'i', $str);
        $str = preg_replace('/[óòõôö]/ui', 'o', $str);
        $str = preg_replace('/[úùûü]/ui', 'u', $str);
        $str = preg_replace('/[ç]/ui', 'c', $str);
        $str = preg_replace('/[,(),;:|!"#$%&/=?~^><ªº-]/', '_', $str);
        $str = preg_replace('/[^a-z0-9]/i', '_', $str);
        $str = preg_replace('/_+/', '_', $str);
        return $str;
    }

    function zeroLeft($number)
    {
        return str_pad($number, 8, 0, STR_PAD_LEFT);
    }

    /*mostra tempo de postagem da msg do aluno*/
    function tempoDePost($dataPost)
    {
        @$dataPost = mktime(((new DateTime($_SESSION['data_ultimo_acesso']))->format('H')),
            ((new DateTime($_SESSION['data_ultimo_acesso']))->format('i')),
            ((new DateTime($_SESSION['data_ultimo_acesso']))->format('s')),
            ((new DateTime($_SESSION['data_ultimo_acesso']))->format('m')),
            ((new DateTime($_SESSION['data_ultimo_acesso']))->format('d')),
            ((new DateTime($_SESSION['data_ultimo_acesso']))->format('Y')));

        $diaH = date('d');
        $mesH = date('m');
        $anoH = date('Y');

        $horaH = date('H');
        $minH = date('i');
        $segH = date('s');

        $ano = date("Y", $dataPost);
        $mes = date("m", $dataPost);
        $dia = date('d', $dataPost);

        $hora = date("H", $dataPost);
        $min = date("i", $dataPost);
        $seg = date("s", $dataPost);

        if ($anoH > $ano) {
            $anos = $anoH - $ano;
            $var = $anos > 1 ? $anos . ' anos' : $anos . ' ano';
        } elseif ($mesH > $mes) {
            $meses = $mesH - $mes;
            $var = $meses > 1 ? $meses . ' meses' : $meses . ' mês';
        } elseif ($diaH > $dia) {
            $dias = $diaH - $dia;
            $var = $dias > 1 ? $dias . ' dias' : $dias . ' dia';
        } elseif ($horaH > $hora) {
            $horas = $horaH - $hora;
            $var = $horas > 1 ? $horas . ' horas' : $horas . ' hora';
        } elseif ($minH > $min) {
            $mins = $minH - $min . ' min';
            $var = $mins;
        } elseif ($segH > $seg) {
            $segs = $segH - $seg . ' seg';
            $var = $segs;
        } else {
            $var = ' agora';
        }
        return $var;
    }

    /*gerar id (numero carteirinha) alfanumerico*/
    function uniqueAlfaNumeric($length = 16)
    {
        $salt = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $len = strlen($salt);
        $pass = '';
        mt_srand(10000000 * (double)microtime());
        for ($i = 0; $i < $length; $i++) {
            $pass .= $salt[mt_rand(0, $len - 1)];
        }
        return $pass;
    }
}

?>