<?php

namespace App\Enum;

enum Genre: string
{
    use BaseTrait;

    case MYSTERY = 'Mystery';
    case FICTION = 'Fiction';
    case SCIFI = 'Sci-fi';
    case THRILLER = 'Thriller';
    case ADVENTURE = 'Adventure';
    case NOVEL = 'Novel';
    case BIOGRAPHY = 'Biography';
}
