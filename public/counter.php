<?php
session_start();

// Path to the counter file
$file_path = 'counter.json';

// Suppress errors and warnings in the output
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
header('Content-Type: application/json');

try {
    // Initialize the counter data structure if the file does not exist
    if (!file_exists($file_path)) {
        $data = [
            'today' => 0,
            'yesterday' => 0,
            'month' => 0,
            'year' => 0,
            'total' => 0,
            'last_updated' => date('Y-m-d')
        ];
        if (file_put_contents($file_path, json_encode($data)) === false) {
            throw new Exception('Gagal membuat file counter.json');
        }
    } else {
        $data = json_decode(file_get_contents($file_path), true);

        // Ensure the 'total' field is present and is a valid number
        if (!isset($data['total']) || !is_numeric($data['total'])) {
            $data['total'] = 0;
        }
    }

    $today = date('Y-m-d');
    $yesterday = date('Y-m-d', strtotime('-1 day'));
    $month = date('Y-m');
    $year = date('Y');

    // Check if the date has changed since the last update
    if ($data['last_updated'] !== $today) {
        // Update counts
        if (date('Y-m-d', strtotime($data['last_updated'])) === $yesterday) {
            $data['yesterday'] = $data['today'];
        } else {
            $data['yesterday'] = 0;
        }
        $data['today'] = 0;
        $data['last_updated'] = $today;
    }

    // Check if the user has already been counted in this session
    if (!isset($_SESSION['visitor_counted'])) {
        // Increment today's count
        $data['today'] += 1;
        $data['month'] += 1;
        $data['year'] += 1;
        $data['total'] += 1;

        // Mark the visitor as counted
        $_SESSION['visitor_counted'] = true;

        // Save the updated data
        if (file_put_contents($file_path, json_encode($data)) === false) {
            throw new Exception('Gagal menyimpan data ke file counter.json');
        }
    }

    // Return the counts as a JSON response
    echo json_encode([
        'today' => $data['today'],
        'yesterday' => $data['yesterday'],
        'month' => $data['month'],
        'year' => $data['year'],
        'total' => $data['total']
    ]);
} catch (Exception $e) {
    // In case of error, log the error and return an error message in JSON format
    error_log($e->getMessage());
    header('Content-Type: application/json', true, 500);
    echo json_encode(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
}
