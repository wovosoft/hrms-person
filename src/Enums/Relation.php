<?php

namespace Wovosoft\HrmsPerson\Enums;

use Wovosoft\LaravelCommon\Traits\HasEnumExtensions;

enum Relation: string
{
    use HasEnumExtensions;

    case Husband = "husband";
    case Wife    = "wife";

    case Father   = "father";
    case Mother   = "mother";
    case Sister   = "sister";
    case Brother  = "brother";
    case Son      = "son";
    case Daughter = "daughter";

    case Father_In_Law   = "father_in_law";
    case Mother_In_Law   = "mother_in_law";
    case Sister_In_Law   = "sister_in_law";
    case Brother_In_Law  = "brother_in_law";
    case Son_In_Law      = "son_in_law";
    case Daughter_In_Law = "daughter_in_law";

    case Maternal_Uncle  = "maternal_uncle";
    case Paternal_Uncle  = "paternal_uncle";
    case Maternal_Aunty  = "maternal_aunty";
    case Paternal_Aunty  = "paternal_aunty";
    case Maternal_Niece  = "maternal_niece";
    case Paternal_Niece  = "paternal_niece";
    case Maternal_Nephew = "maternal_nephew";
    case Paternal_Nephew = "paternal_nephew";

    case Maternal_Uncle_In_Law  = "maternal_uncle_in_law";
    case Paternal_Uncle_In_Law  = "paternal_uncle_in_law";
    case Maternal_Aunty_In_Law  = "maternal_aunty_in_law";
    case Paternal_Aunty_In_Law  = "paternal_aunty_in_law";
    case Maternal_Niece_In_Law  = "maternal_niece_in_law";
    case Paternal_Niece_In_Law  = "paternal_niece_in_law";
    case Maternal_Nephew_In_Law = "maternal_nephew_in_law";
    case Paternal_Nephew_In_Law = "paternal_nephew_in_law";
    case Other                  = "other";
}
