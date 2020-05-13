<?php

namespace App\Service;

class SortDataService
{

    public function orderByDate($a, $b)
    {
        //retourner 0 en cas d'égalité
        if ($a->getDate() == $b->getDate()) {
            return 0;
        } else if ($a->getDate() < $b->getDate()) { //retourner -1 en cas d’infériorité
            return -1;
        } else { //retourner 1 en cas de supériorité
            return 1;
        }
    }
}
