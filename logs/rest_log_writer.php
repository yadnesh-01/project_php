<?php
/**
 * @param string $fileName The name of the file where the log entry occurred.
 * @param string $filePath The full path of the file where the log entry occurred.
 * @param string $activityType Describes whether it's an error or success activity.
 * @param string $remark Additional remarks about the log entry.
 */
function write_log($fileName, $filePath, $activityType, $remark) {

    date_default_timezone_set('Asia/Kolkata'); //Setting Up Indian time zone

    // Specify the log file path
    $logFilePath = '../logs/rest_application.log';

    // Create logs directory if it doesn't exist
    if (!file_exists('../logs')) {
        mkdir('logs', 0755, true);  //0755 gives permission to read, write and run the files in directory 
    }

    // Get current date and time
    $dateTime = date('Y-m-d H:i:s');

    // Format the log entry
    $logEntry = sprintf(
        "[%s] %s | File: %s | Path: %s | %s: %s\n",
        $dateTime,
        $activityType,
        $fileName,
        $filePath,
        $activityType,
        $remark
    );

    // Write log entry to the file
    error_log($logEntry, 3, $logFilePath);
}
?>
