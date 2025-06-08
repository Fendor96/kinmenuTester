<?php
    require_once 'error_log.php';
    class UserDataController{
        private $pdo;
        public function __construct(PDO $pdo){
            $this->pdo = $pdo;
        }

        public function getStudentsByLevel() {
            try {
                $sql = "
                    SELECT
                        c.nom AS level_name,
                        COUNT(e.id) AS student_count
                    FROM classes c
                    LEFT JOIN eleves e ON c.id = e.classe_id
                    GROUP BY c.nom
                    ORDER BY c.nom;
                ";
                $stmt = $this->pdo->query($sql);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log("Erreur getStudentsByLevel: " . $e->getMessage());
                return [];
            }
        }

        public function getUsersInfos($username){
            try{

                $sql = "SELECT * FROM users where username = :username";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([':username'=> $username]);
                return $stmt->fetch(PDO::FETCH_ASSOC);

            }catch(PDOexception $e){
                error_logs("Erreur getUserInfos: " . $e->getMessage());
                return [];
            }
        }

        public function getFavourites($id){
            try{
                $sql="SELECT * FROM tb_favorite where user_id = :id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([':id'=> $id]);
                return $stmt->rowCount();

            }catch(PDOexception $e){
                error_logs("Erreur getFavoris: " . $e->getMessage());
                return [];
            }
        }

        public function getReservations($id){
            try{
                $sql="SELECT * FROM tb_reservation where user_id = :id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([':id'=> $id]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
                
            }catch(PDOexception $e){
                error_logs("Erreur getReservations: " . $e->getMessage());
                return [];
            }
        }

        public function addFavorites($id, $id_restaurant) {
            try {
                // Your SQL INSERT statement is correct
                $sql = "INSERT INTO tb_favorite (user_id, restaurant_id) VALUES (:user_id, :restaurant_id)";
        
                // 1. Use prepare() for security and to bind parameters
                $stmt = $this->pdo->prepare($sql);
        
                // 2. Bind parameters to prevent SQL injection
                // Use meaningful placeholder names (e.g., :user_id, :restaurant_id)
                $stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
                $stmt->bindParam(':restaurant_id', $id_restaurant, PDO::PARAM_INT);
        
                // 3. Execute the prepared statement
                $stmt->execute();
        
                // Optional: Return the ID of the newly inserted row if it's an auto-incrementing primary key
                return $this->pdo->lastInsertId();
        
            } catch (PDOException $e) {
                // Log the error for debugging
                error_log("Erreur addFavorites(): " . $e->getMessage());
        
                // Return false or null to indicate failure, instead of an empty array
                return false;
            }
        }

        public function deleteFavoris($id) {
            try {
                // Correct DELETE syntax and use a placeholder for security
                $sql = "DELETE FROM tb_favorite WHERE user_id = :id";
        
                // Use prepare() for security against SQL injection
                $stmt = $this->pdo->prepare($sql);
        
                // Bind the ID parameter to the placeholder
                $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Specify PDO::PARAM_INT for integer IDs
        
                // Execute the prepared statement
                $stmt->execute();
        
                // Optionally, return the number of affected rows to confirm deletion
                return $stmt->rowCount();
        
            } catch (PDOException $e) {
                // Log the error for debugging purposes
                error_log("Erreur deleteFavoris(): " . $e->getMessage());
        
                // Indicate that the operation failed
                return false;
            }
        }
        public function modifyAccount($id, $username, $email) {
            try {
                $sql = "UPDATE users SET username = :username, email = :email WHERE id = :id";
        
                // Prepare the statement
                $stmt = $this->pdo->prepare($sql);
        
                // Bind parameters
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':id', $id);
        
                // Execute the statement
                $stmt->execute();
        
                // You might want to return true on success or the number of affected rows
                return $stmt->rowCount();
        
            } catch (PDOException $e) {
                // Log the error
                error_log("Erreur modifyAccount(): " . $e->getMessage());
                // Re-throw or return false to indicate failure
                return false;
            }
        }



    } 



?>