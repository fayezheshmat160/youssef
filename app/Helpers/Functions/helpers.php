<?php
// Classes
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArticlesController;




function questionTypes()
{
    return config('question-type');
}






/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// end new

function normalizeName($name)
{

    $patterns     = array("/ي|ئ/", "/إ|أ|آ/", "/ة/", "/َ|ً|ُ|ِ|ٍ|ٌ|ّ/");
    $replacements = array("ى", "ا",  "ه", "");
    return preg_replace($patterns, $replacements, $name);
}


function mainTrans($value)
{
    // Set Translate File Name And Don't Forget Set (.) after file name
    // File Dir => lang\en\dashboard.php
    return trans('main/' . $value);
}

// Get Article Image IF Exists
function articleImg($imgName, $size = 'medium')
{
    $articleController = new ArticlesController;
    switch ($size) {
        case 'large':
            $imgSrc = $articleController::IMG_LARGE_SRC;
            $size = 'large';
            break;
        case 'small':
            $imgSrc = $articleController::IMG_SMALL_SRC;
            $size = 'small';
            break;
        default:
            $imgSrc = $articleController::IMG_MEDIUM_SRC;
            $size = 'medium';
    }

    if (checkFile($imgSrc . $imgName)) {
        $img = asset($imgSrc . $imgName);
    } else {
        $img = asset('assets/images/default/article/' . $size . '.webp');
    }

    return $img;
}

function convertMonthName($englishMonth)
{
    $englishMonths = array(
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    );

    $arabicMonths = array(
        "يناير",
        "فبراير",
        "مارس",
        "أبريل",
        "مايو",
        "يونيو",
        "يوليو",
        "أغسطس",
        "سبتمبر",
        "أكتوبر",
        "نوفمبر",
        "ديسمبر"
    );

    $englishMonthIndex = array_search($englishMonth, $englishMonths);

    if ($englishMonthIndex !== false) {
        return $arabicMonths[$englishMonthIndex];
    } else {
        return "Invalid month name";
    }
}




/**
 * Global
 */
function bootstrapColors()
{
    return ['danger', 'primary', 'success', 'secondary', 'warning', 'info', 'light', 'dark'];
}







/**
 * Get Auth Info
 * $guard = Auth Guard Name
 * $get   = Get Auth Value
 */
function getAuth($guard, $get)
{
    if (Auth::guard($guard)->check()) {
        return auth($guard)->user()->$get;
    } else {
        return NULL;
    }
}





/**
 * Print Message
 * v1
 */
function alert($message, $color = 'info')
{
    /**
     * Check IF The Color Exist In Pallette Or No
     */
    if (in_array($color, bootstrapColors())) {
        // IF Color Ture Print Message
        echo "<div class='text-center alert alert-" . $color . "'>" . $message . "</div>";
    } else {
        /**
         * Else Print Error Message And All Color For Choose
         */
        echo '<div class="container"> <div class="row">';
        echo "<div class='col-12 mb-3'><h6>This Color ( <b class='text-danger'>" . $color . "</b> ) Does Not Exist Choose Your Color From Palettes</h6></div>";
        foreach (bootstrapColors() as $co) {
            echo '<div class="col"><div class="alert alert-' . $co . ' p-2 rounded">' . $co . '</div></div>';
        }
        echo '</div></div>';
    }
}






/**
 * Parse String Time With Carbon Class
 */
function parseTime($time = null)
{
    if ($time == null) {
        $time = date('Y-m-d h:i:s');
    }
    return  Carbon::parse($time)->diffForHumans();
}



/**
 * Format Text
 * 1- Text To Lower Caset
 * 2- First Litter To UpperCase
 */

function formatText($text)
{
    $text = strtolower($text);
    return ucfirst($text);
}






/**
 * Function For Set Actives Class To Blade Pages
 * $url = Page Uri
 * $setClassName = If Need Set Other Class Name
 */
function activeLink($url, $setClassName = 'active')
{
    if (request()->path() ==  $url) {
        return $setClassName;
    } else {
        return false;
    }
}





/**
 * This Function Use For One Row From Database
 * - Check IF Row Exist not empty
 * - If Not Empty Return $column value
 */
function getVal($dbRow, string $column)
{
    return empty($dbRow) ? null : $dbRow[$column];
}
