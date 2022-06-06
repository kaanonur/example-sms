<?php

namespace App\Http\Controllers;

use App\Models\SmsReport;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SmsReportsController extends Controller
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Laravel OpenApi Demo Documentation",
     *      description="L5 Swagger OpenApi description",
     *      @OA\Contact(
     *          email="admin@admin.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Demo API Server"
     * )

     *
     * @OA\Tag(
     *     name="Projects",
     *     description="API Endpoints of Projects"
     * )
     */
    public function sendSms(Request $request)
    {
        SmsReport::create([
            'number' => $request->number,
            'message' => $request->message,
            'send_time' => Carbon::now()
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'message sent'
        ],200);
    }

    /**
     * @OA\Get(
     *      path="/sms-reports",
     *      operationId="smsReports",
     *      tags={"Sms Reports"},
     *      summary="Get list of sms reports",
     *      description="Returns list of sms reports",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       )
     *     )
     */
    public function smsReports(Request $request)
    {
        $smsReports = SmsReport::query();

        if ($request->date) {
            $smsReports = $smsReports->whereDate('send_time', $request->date)->get();
        } else {
            $smsReports = $smsReports->get();
        }

        return response()->json($smsReports);
    }

    public function smsReportDetails(SmsReport $smsReport)
    {
        return response()->json($smsReport);
    }
}
