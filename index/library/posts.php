<?php

include 'library/auth.php';
		function do_post($post_content, $image_url){
			$conn = get_db_connection();
			$username = get_current_username();
			$query = "INSERT INTO `epiz_31761674_lahtp`.`posts` (`content`, `image`, `posted_by`) VALUES ('$post_content', '$image_url', '$username');";

			if(mysqli_query($conn, $query)){
				$post_id = mysqli_insert_id($conn);
				return $post_id;
			} else{
				return NULL;
			}

		}



		function get_post($post_id){
			$conn = get_db_connection();
			$query ="SELECT * FROM epiz_31761674_lahtp.posts WHERE `post_id` = $post_id;";

			$result = mysqli_query($conn, $query);
			if(mysqli_num_rows($result) == 1){
				$row = mysqli_fetch_assoc($result);
				return $row;
			} else{
				return NULL;
			}
		}



		function edit_post($post_id, $post_content){
			$conn = get_db_connection();
			$query = "UPDATE `epiz_31761674_lahtp`.`posts` SET `content` = '$post_content' WHERE (`post_id` = '$post_id');";

			if(mysqli_query($conn, $query)){

				return TRUE;
			} else{
				return FALSE;
			}
		}

		function delete_post($post_id){
			$conn = get_db_connection();
			$post = get_post($post_id);
			if($_COOKIE['username'] == $post['posted_by']){
				$query = "DELETE FROM `epiz_31761674_lahtp`.`posts` WHERE (`post_id` = '$post_id');";

				if(mysqli_query($conn, $query)){
					unlink('./'.$post['image']);
					return TRUE;
				} else{
					return FALSE;
				}
			} else{
				return FALSE;
			}
		}

		function like_post($post_id){
			$conn = get_db_connection();
			$username = get_current_username();
			$query = "INSERT INTO `epiz_31761674_lahtp`.`likes` (`liked_by`, `post_id`) VALUES ('$username', '$post_id');";

			if(mysqli_query($conn, $query)){
				$post_id = mysqli_insert_id($conn);
				return $post_id;
			} else{
				return NULL;
			}

		}

		function get_likes_count($post_id){
			$conn = get_db_connection();
			$query = "SELECT COUNT(*) AS count FROM epiz_31761674_lahtp.likes WHERE `post_id`=$post_id;";
			$result = mysqli_query($conn, $query);
			return mysqli_fetch_assoc($result)['count'];
		}

		function has_liked($post_id){
			$conn = get_db_connection();
			$username = get_current_username();
			$query = "SELECT COUNT(*) AS count FROM epiz_31761674_lahtp.likes WHERE `post_id`=$post_id AND `liked_by` = '$username';";
			$result = mysqli_query($conn, $query);
			if((int)mysqli_fetch_assoc($result)['count'] > 0){
				return True;
			} else{
				return FALSE;
			}
		}

		function get_all_post(){
			$conn = get_db_connection();
			$username = get_current_username();
			$query = "SELECT * FROM epiz_31761674_lahtp.posts order by posted_on DESC;";

			$result = mysqli_query($conn, $query);
			if(mysqli_num_rows($result) > 0){
				$posts = [];
				while($row = mysqli_fetch_assoc($result)){
					$posts[] = $row;
				}
				return $posts;
			} else{
				return [];
			}
		}

		function do_submit($ccontent){
			$conn = get_db_connection();
			$username = get_current_username();
			$comp = $_POST['comp'];
			$query = "INSERT INTO `epiz_31761674_lahtp`.`complaints` (`content`, `submitted_by`) VALUES ('$ccontent', '$username');";

			if(mysqli_query($conn, $query)){
				$post_id = mysqli_insert_id($conn);
				return $com_id;
			} else{
				return NULL;
			}

		}
		


	?>