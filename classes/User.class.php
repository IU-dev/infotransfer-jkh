<?php
	//User.class.php

	require_once 'DB.class.php';

	class User {
		public $id;
		public $username;
		public $displayname;
		public $hashedPassword;
		public $email;
		public $joinDate;
		public $admin;
		public $main;
		public $points;
		public $active;

		function __construct($data) {
			$this->id = (isset($data['id'])) ? $data['id'] : "";
			$this->username = (isset($data['username'])) ? $data['username'] : "";
			$this->displayname = (isset($data['displayname'])) ? $data['displayname'] : "";
			$this->hashedPassword = (isset($data['password'])) ? $data['password'] : "";
			$this->email = (isset($data['email'])) ? $data['email'] : "";
			$this->joinDate = (isset($data['join_date'])) ? $data['join_date'] : "";
			$this->admin = (isset($data['admin'])) ? $data['admin'] : "";
			$this->main = (isset($data['main'])) ? $data['main'] : "";
			$this->points = (isset($data['points'])) ? $data['points'] : "";
			$this->active = (isset($data['active'])) ? $data['active'] : "";
		}

		public function save($isNewUser = false) {
			$db = new DB();
			if(!$isNewUser) {
				$data = array(
					"username" => "'$this->username'",
					"displayname" => "'$this->displayname'",
					"password" => "'$this->hashedPassword'",
					"email" => "'$this->email'",
					"admin" => "'$this->admin'",
					"main" => "'$this->main'",
					"points" => "'$this->points'",
					"active" => "'$this->active'"
					);

				$db->update($data, 'users', 'id = '.$this->id);
			}else {
				$data = array(
					"username" => "'$this->username'",
					"displayname" => "'$this->displayname'",
					"password" => "'$this->hashedPassword'",
					"email" => "'$this->email'",
					"join_date" => "'".date("Y-m-d H:i:s",time())."'",
					"admin" => "0",
					"main" => "'$this->main'",
					"points" => "0",
					"active" => "0"
					);
				$this->id = $db->insert($data, 'users');
				$this->joinDate = time();
			}
			return true;
		}
	}
?>