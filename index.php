<?php
session_start();
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

// GET route
$app->get('/', authorize(array("user", "coach", "admin")),function () use ($app) {$app->render('/user.php');});  
$app->get('/login',function () use ($app) {$app->render('/login.php');});
$app->get('/encuesta',function () use ($app) {$app->render('/encuesta.php');}); 
$app->get('/api/userById/:id','userById');

/*********************************************************/
$app->post('/api/login', 'login');
$app->get('/api/logout', 'logout'); 
/*********************************************************/
$app->post('/api/updateUser','updateUser');
/*********************************************************/
$app->get('/api/postsToMyCoach/:idC/:id/:lastId','postsToMyCoach');
$app->get('/api/PostsToId/:id/:lastId','PostsToId');
$app->post('/api/addPost','addPost');
$app->get('/api/replysById/:id','replysById');
/*********************************************************/
$app->get('/api/studentsById/:id','studentsById'); 
$app->get('/api/studentsById/:id','studentsById'); 
/********************nuevos*************************************/
$app->get('/api/myStudentId/:id','myStudentId');
$app->get('/api/myCoachId/:id','myCoachId'); 
$app->post('/api/chargeSenders','chargeSenders'); 
$app->post('/api/chargePosts','chargePosts'); 

/*********************************************************/
$app->get('/api/getRegisters/:Uid/:date','getRegisters'); 
$app->post('/api/editRegister','editRegister');
$app->post('/api/addRegister','addRegister');
$app->post('/api/deleteRegister','deleteRegister');
$app->get('/api/getActivesGraf/:idU/:year/:type','getActivesGraf'); 

$app->run();
function chargePosts() {
   
	$request = \Slim\Slim::getInstance()->request();
	$wine = json_decode($request->getBody());
	$sql="SELECT posts.id, posts.user_id, posts.reply_id, posts.to_id, posts.modified, posts.text, posts.subject, users.name,users.role, users.src
FROM users, posts 
WHERE (posts.to_id in (".$wine->id.")or(posts.to_id=".$wine->coachId." and posts.user_id=".$wine->myId.") ) and posts.reply_id=0 and posts.user_id=users.id and posts.id >".$wine->lastId." order by posts.modified DESC 
  ";
  //echo($sql);

   	try {
			$db = getConnection();
			$stmt = $db->query($sql);
			$wines = $stmt->fetchAll(PDO::FETCH_OBJ);
			$db = null;
			echo  json_encode($wines);
			
			
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	
	}
function chargeSenders() {
   
	$request = \Slim\Slim::getInstance()->request();
	$wine = json_decode($request->getBody());
	$sql = "select id,src,name,role,coach_id FROM users where id in (".$wine->id.")"; 
   	try {
			$db = getConnection();
			$stmt = $db->query($sql);
			$wines = $stmt->fetchAll(PDO::FETCH_OBJ);
			$db = null;
			echo  json_encode($wines);
			
			
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	
	
}
function myCoachId($id) {
    $sql = "select coach_id FROM users where id = $id ";
    try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $wines = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo  json_encode($wines);
		
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
function myStudentId($id) {
	echo "[";
	 myStudentId2($id,0);
	echo "]";
	}
function myStudentId2($id,$n) {
    $sql = "select id FROM users where coach_id = $id ";
    try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $wines = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
		foreach ($wines as $s){
			if($n>0){echo",";}	
			$n=$n+1;
            echo '{"id":"'.$s->id.'"}';
			myStudentId2($s->id,$n);
			}
        //echo  json_encode($wines);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function postsToMyCoach($idC,$id,$lastId) {
$sql="SELECT posts.id, posts.user_id, posts.reply_id, posts.to_id, posts.modified, posts.text, posts.subject, users.name, users.role, users.src
FROM users, posts
WHERE 
posts.reply_id=0 and  posts.user_id=$id and posts.to_id=$idC and posts.user_id=users.id 
 order by posts.modified DESC
";  
    try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $wines = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo  json_encode($wines);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }}
function PostsToId($id,$lastId) {
$sql="SELECT posts.id, posts.user_id, posts.reply_id, posts.to_id, posts.modified, posts.text, posts.subject, users.name,users.role, users.src
FROM users, posts 
WHERE posts.to_id=$id and posts.reply_id=0 and posts.user_id=users.id and posts.id >$lastId order by posts.modified DESC 
  ";  
    try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $wines = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo  json_encode($wines);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }}



function deleteRegister() {
	$request = \Slim\Slim::getInstance()->request();
	$wine = json_decode($request->getBody());
    $sql = "DELETE FROM registers WHERE id=".$wine->id." ";
    try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $stmt->execute(); 
        $db = null;
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }}//listo
function addRegister() {
   
	$request = \Slim\Slim::getInstance()->request();
	$wine = json_decode($request->getBody());
	//$wine->created=date('Y-m-d'); 
    $sql = "INSERT INTO registers ( user_id,type,description,value,created,category1,category2) VALUES (:user_id, :type, :description, :value, :created, :category1, :category2)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $wine->user_id);
        $stmt->bindParam("type", $wine->type);
        $stmt->bindParam("description", $wine->description);
		$stmt->bindParam("value", $wine->value);
        $stmt->bindParam("created", $wine->created);
		$stmt->bindParam("category1", $wine->category1);
		$stmt->bindParam("category2", $wine->category2); 
		$stmt->bindParam("created", $wine->date); 
        $stmt->execute();
        $wine->id = $db->lastInsertId();
        $db = null;
        echo json_encode($wine);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }}//listo

function editRegister() {
    $request = \Slim\Slim::getInstance()->request();
    $wine = json_decode($request->getBody());
    $sql = "UPDATE registers SET description=:description,value=:value,category1=:category1,category2=:category2 WHERE id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("description", $wine->description);
        $stmt->bindParam("value", $wine->value);
        $stmt->bindParam("category1", $wine->category1);
		$stmt->bindParam("category2", $wine->category2);
        $stmt->bindParam("id", $wine->id);
        $stmt->execute(); 
        $db = null;
        echo json_encode($wine);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
function getRegisters($Uid,$date) {
    $sql = "select id,description,type,value,category1,category2 FROM registers where user_id = $Uid  and LEFT(created,7)='$date'";
    try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $wines = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo  json_encode($wines);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }}//listo





function studentsById($id) {
    $sql = "select id,src,name,role,coach_id FROM users where coach_id = $id ";
    try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $wines = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo  json_encode($wines);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}






function addPost() {
   
	$request = \Slim\Slim::getInstance()->request();
	$wine = json_decode($request->getBody());
	$wine->created=date('Y-m-d H:i:s');
	$wine->modified=date('Y-m-d H:i:s');
	$sql = "INSERT INTO posts ( user_id,to_id,created,modified,text,subject,reply_id) VALUES (:user_id, :to_id, :created, :modified,:text,:subject,:reply_id)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $wine->user_id);
        $stmt->bindParam("to_id", $wine->to_id);
        $stmt->bindParam("created", $wine->created);
        $stmt->bindParam("modified", $wine->modified);
		$stmt->bindParam("text", $wine->text);
		$stmt->bindParam("subject", $wine->subject);
		$stmt->bindParam("reply_id", $wine->reply_id);
        $stmt->execute();
        $wine->id = $db->lastInsertId();
        $db = null;
        echo json_encode($wine);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function updateUser() {
    $request = \Slim\Slim::getInstance()->request();
    $wine = json_decode($request->getBody());
    $sql = "UPDATE users SET email=:email,src=:src, name=:name WHERE id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("email", $wine->email);
        $stmt->bindParam("src", $wine->src);
        $stmt->bindParam("name", $wine->name); 
        $stmt->bindParam("id", $wine->id);
        $stmt->execute();
        $db = null;
        echo json_encode($wine);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}




function logout(){
	$_SESSION = array();
	header('Location: ../login');
	
	}
function authorize($role) {
    return function () use ( $role ) {
        // Get the Slim framework object
        $app = \Slim\Slim::getInstance();
        // First, check to see if the user is logged in at all
        if(!empty($_SESSION['role'])) {
            // Next, validate the role to make sure they can access the route
            // We will assume admin role can access everything
           /* if($_SESSION['role'] == $role || 
                $_SESSION['role'] == 'coach') {*/
			if(in_array($_SESSION['role'], $role)){		
                //User is logged in and has the correct permissions... Nice!
                return true;
            }
            else {
                // If a user is logged in, but doesn't have permissions, return 403
                $app->halt(403, 'You shall not pass!');
            }
        }
        else {
            // If a user is not logged in at all, return a 401
           // echo '{"error":{"text":"Username and Password are required."}}';
			header('Location: ../login');
			//$app->halt(401, 'You shall not pass!');
			
        }
    };
}
function login(){
	if(!empty($_POST['email']) && !empty($_POST['password'])) {
		$sql = "select id,email,password,role FROM users where email='".$_POST['email']."' and password='".$_POST['password']."'";
		try {
			$db = getConnection();
			$stmt = $db->query($sql);
			$wines = $stmt->fetchAll(PDO::FETCH_OBJ);
			$db = null;
			//echo  json_encode($wines);
			//echo $wines['0']['email'];
			
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
		if(isset($wines[0]->id)){
			$_SESSION['id'] = $wines[0]->id;
			$_SESSION['role']=$wines[0]->role;
			echo '{"good":{"text":"ok"}}';
			
			}
		else {
			echo '{"error":{"text":"El email y la contraseña no coinciden. Intentalo nuevamente"}}';
		}
	}
	else {
		echo '{"error":{"text":"Necesitas ingresar un email y tu contraseña."}}';
	}
	
	
	}






function userById($id) {
    $sql = "select id,email,src,name,role,coach_id FROM users where id = $id ";
    try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $wines = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo  json_encode($wines);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
function getActivesGraf($idU, $year,$type){ 
	$sql = "SELECT (MONTH( created )-1) AS 
x , SUM( value ) AS y
FROM registers  
WHERE TYPE ='$type' and year(created)=$year and user_id=$idU
GROUP BY  MONTH( created )"; 
	 try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $wines = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
		echo  json_encode($wines,JSON_NUMERIC_CHECK);	 
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function replysById($id) {
$sql="SELECT posts.id, posts.user_id, posts.reply_id, posts.to_id, posts.modified, posts.text, posts.subject, users.name, users.role, users.src
FROM users, posts
WHERE users.id = posts.user_id and (posts.reply_id=$id or posts.id=$id)
ORDER BY posts.created ASC"; 
    try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $wines = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo  json_encode($wines);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}




function getConnection() {
    $dbhost="localhost";
    $dbuser="edicurso";
    $dbpass="I9T*;2h(7a2?";
    $dbname="edicurso_prueba";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}



