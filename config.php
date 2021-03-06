<?php
/*

// Multicoin-Faucet


Copyright (c) <2014> <Christian Grieger>
Copyright (C) <2019>  <WlanWerner>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.

*/

// Modify these settings to suit your needs.

$config = array(
    
    // e.g. Dogecoin
    "coinname" => "Jumpcoin",
    
	// RPC settings:
	// These are the settings you put into e.g. dogecoin.conf. They allow the faucet to interact with your wallet
    "rpc_user" => "rpcuser",
	"rpc_password" => "rpcpassword",
	"rpc_host" => "rpchost",	//If the Wallet runs on the local server the host is probably localhost
	"rpc_port" => "rpcport",

	// MySQL settings:
    "mysql_user" => "db_user",
	"mysql_password" => "db_password",
	"mysql_host" => "localhost",
	"mysql_database" => "faucet", // faucet database name
	"mysql_table_prefix" => "sf_", // table prefix to use , normally there is no need to change it

	// Coin values:
	"minimum_payout" => 1, // minimum coins to be awarded, if value below 1 use a . and not a , (example: 0.5 and NOT 0,5)
	"maximum_payout" => 6, // maximum coins to be awarded, if value below 1 use a . and not a , (example: 0.5 and NOT 0,5)
	"payout_threshold" => 10, // payout threshold, if the faucet contains less coins than this, display the 'dry_faucet' message
	"payout_interval" => "1h", // payout interval, the wait time for a user between payouts. Type any numerical value with either a "m" (minutes), "h" (hours), or "d" (days), attached. Examples: 50m for a 50 minute delay, 7h for a 7 hour delay, etc.

    
    // Payment system:
	"stage_payments" => true, // stage payments in the database, to be executed later
	"stage_payment_account_name" => "", // account name to send transactions with, needs to be valid // you also can leave it empty
	"staged_payment_threshold" => 10, // staged payment threshold, all staged payments are executed when this number is reached
	"staged_payment_cron_only" => false, // ignore the stage_amount counter, only execute staged payments when the cron script is called
    
	// this option has 3 possible values: "ip_address", "coin_address", and "both". It defines what to check for when a user enters a coin address in order to decide whether or not to award coins to this user.
	// "ip_address": checks the user IP address in the payout history.
	// "coin_address": checks the user coins address in the payout history.
	// "both": check both the IP and coins address in the payout history.
	"user_check" => "both",

	"use_captcha" => true, // require the user to enter a captcha

	"captcha" => "recaptcha2", // valid options: recaptcha2, solvemedia

	"captcha_https" => true, // use https (only for recaptcha2) valid options: true, false

	// enter your private and public reCAPTCHA key here:
	"captcha_config" => array(
		"private_key" => "privatekey",
		"public_key" => "publickey"
		),

	// enter your private and public solvemedia key here:
	"solvemedia_config" => array(
		"public_key" => "publickey",
		"private_key" => "privatekey",
		"hash_key" => "hashkey"
	),
    
    // proxy filter:
	"filter_proxies" => true, // whether to filter proxies or not. It's up to you to fill the proxy ban table. (see also the tor node cron job in ./lib/proxy_filter/cron/tor.php)
	"proxy_filter_use_faucet_database" => false, // whether the proxy filter should use the faucet database connection or not. (if set to false, the proxy filter will connect to the database set in ./lib/proxy_filter/config.php)
    
    // promo codes:
	"use_promo_codes" => false, // accept promo codes

    
	// if the wallet is encrypted, enter the PASSPHRASE here. Leave it blank otherwise!
	"wallet_passphrase" => "",

	// Donation address:
	"donation_address" => "DTiUqjQTXwgZfvcTcdoabp7uLezK47TPkN", // donation address to display

	// Faucet look and feel:
	"title" => "Coin Faucet", // page title, may be used by the template too
	"template" => "basic", // template to use (see the templates directory)
    //code for advertisements:
	//If you want to insert ads from a ads supplier just pate the iframe code between the " "
	// For further examples or if you want to know how to add manually banners with ref link please have a look at the github documentation
    "ad-top" => "",  
    "ad-left" => "",
    "ad-right" => "",
    "ad-middle" => ""
	);


// Do not change this.
defined("SIMPLE_FAUCET") || header(".");
?>
