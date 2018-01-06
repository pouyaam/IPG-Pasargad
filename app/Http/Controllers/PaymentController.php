<?php
namespace App\Http\Controllers;

use App\Library\Utils\RSAKeyType;
use App\Library\Utils\RSAProcessor;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $amount = $request->input("amount");

        $processor = new RSAProcessor("./certificate.xml", RSAKeyType::XMLFile);

        $merchantCode = env('IPG_MERCHANT_CODE', false); // كد پذيرنده
        $terminalCode = env('IPG_TERMINAL_CODE', false); // كد ترمينال
        $redirectAddress = env('IPG_REDIRECT_URL', false);

        $invoiceNumber = 16525; //شماره فاكتور
        $timeStamp = date("Y/m/d H:i:s");
        $invoiceDate = date("Y/m/d H:i:s"); //تاريخ فاكتور
        $action = "1003";    // 1003 : براي درخواست خريد
        $data = "#" . $merchantCode . "#" . $terminalCode . "#" . $invoiceNumber . "#" . $invoiceDate . "#" . $amount . "#" . $redirectAddress . "#" . $action . "#" . $timeStamp . "#";
        $data = sha1($data, true);
        $data = $processor->sign($data); // امضاي ديجيتال
        $result = base64_encode($data); // base64_encode


        $data = compact(['merchantCode', 'terminalCode', 'redirectAddress', 'invoiceNumber', 'timeStamp', 'invoiceDate', 'action', 'result', 'amount']);

        return view('payment', $data);
    }


    public function show(Request $request)
    {
        dd($request);
    }

    function makeXMLTree($data)
    {
        $ret = array();
        $parser = xml_parser_create();
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_parse_into_struct($parser, $data, $values, $tags);
        xml_parser_free($parser);
        $hash_stack = array();
        foreach ($values as $key => $val) {
            switch ($val['type']) {
                case 'open':
                    array_push($hash_stack, $val['tag']);
                    break;
                case 'close':
                    array_pop($hash_stack);
                    break;
                case 'complete':
                    array_push($hash_stack, $val['tag']);
                    // uncomment to see what this function is doing
                    // echo("\$ret[" . implode($hash_stack, "][") . "] = '{$val[value]}';\n");
                    eval("\$ret[" . implode($hash_stack, "][") . "] = '{$val[value]}';");
                    array_pop($hash_stack);
                    break;
            }
        }
        return $ret;
    }
}
