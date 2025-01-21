<?php
// Include the data fetch function
include 'monthly_get_data.php';

if (isset($_GET['function'])) {
    $functionName = $_GET['function'];
    switch ($functionName) {
        case 'fetchData_stocks':
            $data = fetchData_product();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        case 'Fetch_daily_details':
            $data = fetch_stocks();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        case 'add_new_entry':
            $data = add_daily_details();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        case 'bulk_upload_details':
            $data = bulk_upload_details();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        case 'fetch_calc_details':
            $data = fetch_calc_details();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        case 'fetch_calc_details_up_support':
            $data = fetch_calc_details_up_support();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        case 'fetch_calc_details_up_support_get_table':
            $data = fetch_calc_details_up_support_get_table();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        
        case 'fetch_calc_details_down_support_get_table':
            $data = fetch_calc_details_down_support_get_table();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        
        case 'fetch_calc_details_up_support_val':
            $data = fetch_calc_details_up_support_val();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        
        case 'fetch_calc_details_high_support_val':
            $data = fetch_calc_details_high_support_val();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        
        case 'fetch_calc_details_up_support_get_table_put_call':
            $data = fetch_calc_details_up_support_get_table_put_call();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        
        case 'fetch_calc_details_high_get_table_put_call':
            $data = fetch_calc_details_high_get_table_put_call();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        case 'get_stocks':
            $data = get_stocks();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        case 'add_new_stock':
            $data = add_new_stock();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        case 'edit_new_stock':
            $data = edit_new_stock();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        case 'edit_new_stock_details':
            $data = edit_new_stock_details();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        case 'dele_new_stock_details':
            $data = dele_new_stock_details();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        case 'get_data_stocks_dash':
            $data = get_data_stocks_dash();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        case 'delete_details_trunc':
            $data = delete_details_trunc();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        case 'dele_new_details_details':
            $data = dele_new_details_details();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        case 'get_daily_counts':
            $data = get_daily_counts();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        case 'get_monthly_counts':
            $data = get_monthly_counts();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        case 'get_weekly_counts':
            $data = get_weekly_counts();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        default:
            // Handle invalid function name
            $data = array('error' => 'Invalid function name');
            break;
    }

}

?>