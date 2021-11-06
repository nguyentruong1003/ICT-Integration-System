<?php
/**
 * Return nav-here if current path begins with this path.
 *
 * @param string $path
 * @return string
 */

use App\Models\GwApproveResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

function setActive($path)
{
    return \Request::is($path . '*') ? ' class=active' : '';
}

function setOpen($path)
{
    return \Request::is($path . '*') ? ' class=open' : '';
}

function getAdminName($id)
{
    $result = \App\Admin::findOrFail($id);
    return $result['name'];
}


function reFormatDate($datetime, $format = null)
{
    if (empty($datetime)) {
        return '';
    }

    if ($format == null) {
        $format = config('common.formatDate');
    }
    return (($datetime != '0000-00-00 00:00:00') && ($datetime != '0000-00-00')) ? date($format, strtotime($datetime)) : '';
}

function formatDateLocale($datetime, $format) {
    if (empty($datetime)) {
        return '';
    }
    $locale = app()->getLocale();
    $result = strftime($format,strtotime($datetime));
    if($locale == 'vi') {
        $result = toVietnameseWeekdays($result);
    }

    return $result;
}

function toVietnameseWeekdays($date) {
    $map = [
        'Mon' => 'Thứ hai',
        'Tue' => 'Thứ ba',
        'Wed' => 'Thứ tư',
        'Thu' => 'Thứ năm',
        'Fri' => 'Thứ sáu',
        'Sat' => 'Thứ bảy',
        'Sun' => 'Chủ nhật',
    ];
    foreach(array_keys($map) as $item) {
        if(strpos($date, $item) !== false) {
            $date = str_replace($item,$map[$item],$date);
        }
    }
    return $date;
}

function numberFormat($money = 0, $dec_point = '.', $thousands_sep = ',')
{
    $arr = explode('.', sprintf("%.2f", $money));
    $decimal = (count($arr) > 1 && $arr[1] != '00') ? 2 : 0;
    return number_format($money, $decimal, $dec_point, $thousands_sep);
}

function ratioFormat($val, $total, $number)
{
    if ($val == 0) {
        return '0%';
    }
    return round($val*100/$total, $number) . '%';
}

function decodeEmoji($content)
{
    return \App\Emoji::Decode($content);
}

function strLimit($str, $limit = 30, $end = '...')
{
    if (strlen($str) > $limit){
        return Str::limit($str, $limit, $end);
    }
    return $str;
}

function getToday()
{
    $today = date("m/d/Y");

    return $today . ' - ' . $today;
}

function get7Day()
{
    $today = date('m/d/Y');

    $sevenDay = date('m/d/Y', strtotime("-7 days"));

    return $sevenDay . ' - ' . $today;
}

function getTodayPicker()
{
    $today = date("m/d/Y");

    return $today . ' - ' . $today;
}

//diepth: dung cho trang hien thi link
function checkPermission($permission)
{
    if (Auth::user()->hasRole('administrator')) {
        return true;
    }
    if (Auth::user()->can($permission)) {
        return true;
    }
    return false;
}

//diepth: dung cho trang index
function checkButtonCanView($action)
{
    $router_name = Route::getCurrentRoute()->getName();
    $permission = str_replace('index', $action, $router_name);
    return checkPermission($permission);
}

function checkRoutePermission($action) {
    $routerName = Route::getCurrentRoute()->getName();
    $arr = explode('.', $routerName);
    $arr[count($arr) - 1] = $action;
    $permission = join('.', $arr);
    return checkPermission($permission);
}


function getMailReply($id)
{
    return \App\Message::where(['parentId' => $id, 'status' => 1])->get();
}

function getMasterMailReply($id)
{
    return \App\Message::where(['parentId' => $id, 'status' => 1, 'senderUserId' => 1000000])->get();
}

function stringLimit($str, $limit = 30)
{
    return Str::limit($str, $limit);
}

function boldTextSearch($text, $searchTerm)
{
    return str_replace($searchTerm, '<b>' . $searchTerm . '</b>', $text);

}
function boldTextSearchV2($text, $searchTerm){
    if (!strlen($searchTerm)) {
        return $text;
    }
    $newText = strtolower(removeStringUtf8($text));
    $newSearchTerm = strtolower(removeStringUtf8($searchTerm));
    $lengText = strlen($newText);
    $lengSearchTerm = strlen($newSearchTerm);
    $index = 0;
    for($i = 0; $i <= $lengText - $lengSearchTerm; $i++){
        if($newSearchTerm==substr($newText,$i,$lengSearchTerm)){
            $text = mb_substr($text,0,$i+$index).'<b>'.mb_substr($text,$i+$index,$lengSearchTerm).'</b>'.mb_substr($text,$i + $index + $lengSearchTerm ,$lengText-$i-$lengSearchTerm);
            $index+=5;
        }
    }
    return $text;

}
function getLeaveDate($end_date, $start_date){
    $start = Carbon::parse(reFormatDate($start_date,'Y-m-d'));
    $end = Carbon::parse(reFormatDate($end_date,'Y-m-d'));
    $end->modify('+1 day');

    if (strtotime($start->format('Y-m-d'))>=strtotime($end->format('Y-m-d'))) {
        $countDate = 0;
    } else {
        $countDate = $end->diffInDays($start);
    }

    $days = $countDate*2;

    $fromHour = reFormatDate($start_date,'H:i');
    $toHour = reFormatDate($end_date,'H:i');
    if ($fromHour == '08:30') {
        $fromHour = 1;
    } else {
        $fromHour = 2;
    }
    if ($toHour == '12:00') {
        $toHour = 1;
    } else {
        $toHour = 2;
    }

    $holidays = \App\Models\Holiday::pluck('date_time')->toArray();
    foreach($holidays as $key => $value){
        $holidays[$key] = reFormatDate($holidays[$key],'d-m-Y');
    }

    $day_in_week = Carbon::parse(reFormatDate($start_date,'Y-m-d'))->format('N');
    if ($day_in_week % 7 == 0 || $day_in_week % 7 == 6 || in_array(reFormatDate($start_date,'d-m-Y'), $holidays)) {
        $fromHour = 1;
    }
    $day_in_week = Carbon::parse(reFormatDate($end_date,'Y-m-d'))->format('N');
    if ($day_in_week % 7 == 0 || $day_in_week % 7 == 6 || in_array(reFormatDate($end_date,'d-m-Y'),$holidays)) {
        $toHour = 2;
    }
    $days = $days + 1 - $fromHour - 2 + $toHour;

    $day_in_week = Carbon::parse($start_date)->format('N');
    $sub_day = 0;

    $startDate = Carbon::parse($start_date);
    for ($i=0; $i < $countDate; $i++){
        $date = $startDate->format('d-m-Y');
        $startDate->modify('+1 day');
        if ($day_in_week % 7 == 0 || $day_in_week % 7 == 6 || in_array($date,$holidays)) {
            $sub_day += 2;
        }
        $day_in_week++;
    }
    $leaveDay = ($days-$sub_day)/2;
    $leaveDay = ($leaveDay>0) ? $leaveDay : 0;
    return $leaveDay;
}
function removeStringUtf8($str)
{
    $hasSign = array(
        'à', 'á', 'ạ', 'ả', 'ã', 'â', 'ầ', 'ấ', 'ậ', 'ẩ', 'ẫ', 'ă', 'ằ', 'ắ', 'ặ', 'ẳ', 'ẵ', '&agrave;', '&aacute;', '&acirc;', '&atilde;',
        'è', 'é', 'ẹ', 'ẻ', 'ẽ', 'ê', 'ề', 'ế', 'ệ', 'ể', 'ễ', '&egrave;', '&eacute;', '&ecirc;',
        'ì', 'í', 'ị', 'ỉ', 'ĩ', '&igrave;', '&iacute;', '&icirc;',
        'ò', 'ó', 'ọ', 'ỏ', 'õ', 'ô', 'ồ', 'ố', 'ộ', 'ổ', 'ỗ', 'ơ', 'ờ', 'ớ', 'ợ', 'ở', 'ỡ', '&ograve;', '&oacute;', '&ocirc;', '&otilde;',
        'ù', 'ú', 'ụ', 'ủ', 'ũ', 'ư', 'ừ', 'ứ', 'ự', 'ử', 'ữ', '&ugrave;', '&uacute;',
        'ỳ', 'ý', 'ỵ', 'ỷ', 'ỹ', '&yacute;',
        'đ', '&eth;',
        'À', 'Á', 'Ạ', 'Ả', 'Ã', 'Â', 'Ầ', 'Ấ', 'Ậ', 'Ẩ', 'Ẫ', 'Ă', 'Ằ', 'Ắ', 'Ặ', 'Ẳ', 'Ẵ', '&Agrave;', '&Aacute;', '&Acirc;', '&Atilde;',
        'È', 'É', 'Ẹ', 'Ẻ', 'Ẽ', 'Ê', 'Ề', 'Ế', 'Ệ', 'Ể', 'Ễ', '&Egrave;', '&Eacute;', '&Ecirc;',
        'Ì', 'Í', 'Ị', 'Ỉ', 'Ĩ', '&Igrave;', '&Iacute;', '&Icirc;',
        'Ò', 'Ó', 'Ọ', 'Ỏ', 'Õ', 'Ô', 'Ồ', 'Ố', 'Ộ', 'Ổ', 'Ỗ', 'Ơ', 'Ờ', 'Ớ', 'Ợ', 'Ở', 'Ỡ', '&Ograve;', '&Oacute;', '&Ocirc;', '&Otilde;',
        'Ù', 'Ú', 'Ụ', 'Ủ', 'Ũ', 'Ư', 'Ừ', 'Ứ', 'Ự', 'Ử', 'Ữ', '&Ugrave;', '&Uacute;',
        'Ỳ', 'Ý', 'Ỵ', 'Ỷ', 'Ỹ', '&Yacute;',
        'Đ', '&ETH;',
    );
    $noSign = array(
        'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a',
        'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e',
        'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i',
        'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o',
        'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u',
        'y', 'y', 'y', 'y', 'y', 'y',
        'd', 'd',
        'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A',
        'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E',
        'I', 'I', 'I', 'I', 'I', 'I', 'I', 'I',
        'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O',
        'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U',
        'Y', 'Y', 'Y', 'Y', 'Y', 'Y',
        'D', 'D'
    );

    $str = str_replace($hasSign, $noSign, $str);
    return $str;
}

function calculateMonth($from, $to = 'now')
{

    $ts1 = strtotime($from);
    $ts2 = strtotime($to);

    $year1 = date('Y', $ts1);
    $year2 = date('Y', $ts2);

    $month1 = date('m', $ts1);
    $month2 = date('m', $ts2);

    return (($year2 - $year1) * 12) + ($month2 - $month1);
}

function checkShowMode()
{
    $name = Route::getCurrentRoute()->getName();
    $arr = explode(".", $name);
    $action = end($arr);
    if ($action == 'show') {
            return true;
    }
    return false;
}

function textRequired($checkShowMode) {
    if ($checkShowMode) {
            return '';
    }
    return '(*)';
}

function removeFormatNumber($number, $specials = ['.', ','])
{
    foreach ($specials as $special) {
        $number = str_replace($special, '', $number);
    }
    return (int)$number;
}


function getDataRequest(){
    $admin_id = Auth::user()->id;
    try {
        $response = Http::get('http://gw.vkist.gov.vn/ngw/approval/sso/token', [
            'id' => 'audit',
            'empno' => '1',
        ]);
    } catch (Exception $e) {
        Log::error('(LoginGwController/handleRequest) Caught exception (get_token): '.$e->getMessage().', '.$admin_id);
    }

    if(!$response->json()['success']){
        Log::error('(LoginGwController/handleRequest) Approval request denied, ip is not allowed: '. json_encode($response));
        return [
            'success' => false,
            'message' => 'Gửi đề tài thất bại, IP không được cho phép',
        ];
    }
    $token = $response->json()['data']['token'];

    return ['success' => true, 'token' => $token,];
}

function renderFromTemplate($template, array $data) {

    if (empty($data)) return '';

    $data = Arr::dot($data);

    $keys = array_map(fn($key) => ":$key", array_keys($data));
    $values = array_values($data);

    return str_replace($keys, $values, $template);
}

function handleRequestLeave($requestLeaveID){
    $requestLeave = \App\Models\RequestLeave::FindorFail($requestLeaveID);
    // tìm user
    $user = \App\Models\User::find($requestLeave->admin_id);
    // tìm userInf để xử lý
    $userInf = $user?\App\Models\UserInf::find($user->user_info_id):null;
    if($userInf){
        // nếu có lưu trong DB số ngày nghỉ thì lấy ra, không thì dùng hàm để tính dựa theo ngày bắt đầu và ngày kết thúc
        $dayLeave = $requestLeave->leave_day?$requestLeave->leave_day:getLeaveDate($requestLeave->end_date, $requestLeave->start_date);
        $config = \App\Models\SystemConfig::where('type',2)->get()->first();
        $config = $config->content;
        $config = $config['unused_leave_to_new_year'];
        $currentYear = now()->format('Y');
        if($config['check']){
            if($config['expired_in']['check']){
                $date = '01/'.$config['expired_in']['value'].'/'.($currentYear);
                $date =  Carbon::parse(reFormatDate($date))->format('Y/m/t');
                $date1 = Carbon::parse(now()); //ngày hiện tại
                $date2 =  Carbon::parse($date);
                if($date1->greaterThan($date2)){
                    $leaveDayLastYear = 0;
                }
                else {
                    if($config['value']=='limit'){
                        $limit = (int) $config['limit'];
                        $leaveDayLastYear = (isset($userInf->leave_day_last_year)&&$userInf->leave_day_last_year)?(float) $userInf->leave_day_last_year:0;
                        $leaveDayLastYear = ($leaveDayLastYear>$limit)?$limit:$leaveDayLastYear;
                    }
                    else {
                        $leaveDayLastYear = (isset($userInf->leave_day_last_year)&&$userInf->leave_day_last_year)?(float) $userInf->leave_day_last_year:0;
                    }
                }
            }
            else {
                $leaveDayLastYear = 0;
            }
        }
        else {
            $leaveDayLastYear = 0;
        }
        $leaveDayCurrentYear = (isset($userInf->leave_day_current_year)&&$userInf->leave_day_current_year)?(float) $userInf->leave_day_current_year:0;
        if($leaveDayLastYear >= $dayLeave ){
            $userInf->leave_day_last_year = $leaveDayLastYear - $dayLeave;
        } else {
            $userInf->leave_day_last_year = 0;
            $userInf->leave_day_current_year = $leaveDayCurrentYear + $dayLeave - $leaveDayLastYear;
        }
        \App\Models\UserInf::where('id', $user->user_info_id)->update([
            'leave_day_last_year' => $userInf->leave_day_last_year,
            'leave_day_current_year' => $userInf->leave_day_current_year,
        ]);
    }
}

function getSeniority(){
    $config = \App\Models\SystemConfig::where('type',2)->get()->first();
    $config = $config->content;
    $config = $config['increase_leave_by_seniority'];
    if(!$config['check']){
        return 0;
    }
    else {
        if($config['value']!='customize'){
            $userInf = Auth()->user()->info;
            $contract = '';
            if($userInf){
                $contract = \App\Models\Contract::where('user_info_id', $userInf->id)->orderBy('contract.start_date','ASC')->get()->first();
            }
            if(isset($contract->start_date)&&$contract->start_date){
                $date = $contract->start_date;
                $curentMonth =  (int)Carbon::parse(now())->format('m');
                $curentYear = (int)Carbon::parse(now())->format('Y');
                $curentDate = (int)Carbon::parse(now())->format('d');
                $signMonth = (int)Carbon::parse($date)->format('m');
                $signYear = (int)Carbon::parse($date)->format('Y');
                $signDate = (int)Carbon::parse($date)->format('d');

                $countDate = $curentYear*12 + $curentMonth - $signMonth - $signYear*12;
                if ($curentDate - $signDate >= 15) {
                    $countDate++;
                }
                return round($countDate/12/5);

            }
            else {
                return 0;
            }
        }
        else {
            $userInf = Auth()->user()->info;
            $contract = '';
            if($userInf){
                $contract = \App\Models\Contract::where('user_info_id', $userInf->id)->orderBy('contract.start_date','ASC')->get()->first();
            }
            if(isset($contract->start_date)&&$contract->start_date){
                $date = $contract->start_date;
                $curentMonth =  (int)Carbon::parse(now())->format('m');
                $curentYear = (int)Carbon::parse(now())->format('Y');
                $curentDate = (int)Carbon::parse(now())->format('d');
                $signMonth = (int)Carbon::parse($date)->format('m');
                $signYear = (int)Carbon::parse($date)->format('Y');
                $signDate = (int)Carbon::parse($date)->format('d');

                $countDate = $curentYear*12 + $curentMonth - $signMonth - $signYear*12;
                if ($curentDate-$signDate>=15) {
                    $countDate++;
                }

                $year = (int)$config['customize']['passed_years'];
                $day = (int)$config['customize']['addition_days'];
                if ($year == 0) {
                    $year = 1; // tránh gây lỗi khi year = 0
                }
                $seniority  = round($countDate/12/$year)*$day;
                return (int) $seniority;
            }
            else {
                return 0;
            }
        }
    }
}

