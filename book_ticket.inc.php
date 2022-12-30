<?php
require_once 'config/dbConfig.php';
require_once('https://github.com/stripe/stripe-php/blob/master/init.php');

session_start(); 

if (isset($_POST['confirm'])) {
 $ui_query = "SELECT user_id FROM tbl_user WHERE user_email='".$_SESSION['active_user']."'";
 $ui_result = mysqli_query($dbConn, $ui_query); 
 $ui_data = mysqli_fetch_assoc($ui_result);

      $p_row_id = [];
      $plat_arr = [];
	  foreach (range('H', 'E') as $alphabet) {
	  	array_push($p_row_id, $alphabet);
	  }
	  for ($row=0; $row < 4 ; $row++) { 
	  	
	  	for ($seat=1; $seat <= 18 ; $seat++) {
	  	  $seat_id = $p_row_id[$row].$seat;
	  	  array_push($plat_arr, $seat_id);
	    }
	    
	  }

	  $s_row_id = [];
	  $sil_arr = [];
	  foreach (range('D', 'A') as $alphabet) {
	  	array_push($s_row_id, $alphabet);
	  }
	  for ($row=0; $row < 4 ; $row++) { 
	  	
	  	for ($seat=1; $seat <= 18 ; $seat++) {
	  	  $seat_id = $s_row_id[$row].$seat;
	  	  array_push($sil_arr, $seat_id);
	    }
	    
	  }

	  foreach ($_POST['seat'] as $seat_list => $seat) {
	  	if (in_array($seat, $plat_arr)) {

	  		echo "Platinum<br>";
	  		// \Stripe\Stripe::setApiKey('YOUR_SECRET_API_KEY');
		   //  $card = array(
		   //      'number' => $_POST['card'],
		   //      'name' => $_POST['ccName'],
		   //      'exp_month' => $_POST['month'],
		   //      'exp_year' => $_POST['year'],
		   //      'cvv' => $_POST['cvv']
		   //  );
		   //  $success = null;
		   //  try {
		   //      $c = \Stripe\Charge::create(
		   //          array(
		   //              'amount' => '150',
		   //              'currency' => 'inr',
		   //              'description' => 'Your movie ticket is booked.',
		   //              'card' => $card
		   //          )
		   //      );
		   //      $success = 1;
		   //  } catch (Stripe_CardError $e) {
		   //      $error = $e->getMessage();
		   //      header('location: book_ticket.php?show='.$_POST['show'].'&error='.$error);
		   //  } catch (Stripe_InvalidRequestError $e) {
		   //      // Invalid parameters were supplied to Stripe's API
		   //      $error = $e->getMessage();
		   //      header('location: book_ticket.php?show='.$_POST['show'].'&error='.$error);
		   //  } catch (Stripe_AuthenticationError $e) {
		   //      // Authentication with Stripe's API failed
		   //      $error = $e->getMessage();
		   //      header('location: book_ticket.php?show='.$_POST['show'].'&error='.$error);
		   //  } catch (Stripe_ApiConnectionError $e) {
		   //      // Network communication with Stripe failed
		   //      $error = $e->getMessage();
		   //      header('location: book_ticket.php?show='.$_POST['show'].'&error='.$error);
		   //  } catch (Stripe_Error $e) {
		   //      // Display a very generic error to the user, and maybe send
		   //      // yourself an email
		   //      $error = $e->getMessage();
		   //      header('location: book_ticket.php?show='.$_POST['show'].'&error='.$error);
		   //  } catch (Exception $e) {
		   //      // Something else happened, completely unrelated to Stripe
		   //      $error = $e->getMessage();
		   //      header('location: book_ticket.php?show='.$_POST['show'].'&error='.$error);
		   //  }

		    $booking_query = "INSERT INTO tbl_ticket(show_id, user_id, seat_no) VALUES('".$_POST['show']."', '".$ui_data['user_id']."', '".$seat."')";
		    $booking_result = mysqli_query($dbConn, $booking_query);
		    if ($booking_result) {
		    	header('location: index.php');
		    }
	  	}elseif (in_array($seat, $sil_arr)) {
	  		echo "Silver";
	  		// \Stripe\Stripe::setApiKey('YOUR_SECRET_API_KEY');
		   //  $card = array(
		   //      'number' => $_POST['card'],
		   //      'name' => $_POST['ccName'],
		   //      'exp_month' => $_POST['month'],
		   //      'exp_year' => $_POST['year'],
		   //      'cvv' => $_POST['cvv']
		   //  );
		   //  $success = null;
		   //  try {
		   //      $c = \Stripe\Charge::create(
		   //          array(
		   //              'amount' => '110',
		   //              'currency' => 'inr',
		   //              'description' => 'Your movie ticket is booked.',
		   //              'card' => $card
		   //          )
		   //      );
		   //      $success = 1;
		   //  } catch (Stripe_CardError $e) {
		   //      $error = $e->getMessage();
		   //      header('location: book_ticket.php?show='.$_POST['show'].'&error='.$error);
		   //  } catch (Stripe_InvalidRequestError $e) {
		   //      // Invalid parameters were supplied to Stripe's API
		   //      $error = $e->getMessage();
		   //      header('location: book_ticket.php?show='.$_POST['show'].'&error='.$error);
		   //  } catch (Stripe_AuthenticationError $e) {
		   //      // Authentication with Stripe's API failed
		   //      $error = $e->getMessage();
		   //      header('location: book_ticket.php?show='.$_POST['show'].'&error='.$error);
		   //  } catch (Stripe_ApiConnectionError $e) {
		   //      // Network communication with Stripe failed
		   //      $error = $e->getMessage();
		   //      header('location: book_ticket.php?show='.$_POST['show'].'&error='.$error);
		   //  } catch (Stripe_Error $e) {
		   //      // Display a very generic error to the user, and maybe send
		   //      // yourself an email
		   //      $error = $e->getMessage();
		   //      header('location: book_ticket.php?show='.$_POST['show'].'&error='.$error);
		   //  } catch (Exception $e) {
		   //      // Something else happened, completely unrelated to Stripe
		   //      $error = $e->getMessage();
		   //      header('location: book_ticket.php?show='.$_POST['show'].'&error='.$error);
		   //  }

		    $booking_query = "INSERT INTO tbl_ticket(show_id, user_id, seat_no) VALUES('".$_POST['show']."', '".$ui_data['user_id']."', '".$seat."')";
		    $booking_result = mysqli_query($dbConn, $booking_query);
		    if ($booking_result) {
		    	header('location: index.php');
		    	
		    }

	  	}
	  }

	  
 

 print_r($_POST);

 
}