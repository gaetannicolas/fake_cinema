-- Rajouter un film : 
INSERT INTO films (`id`, `title`, `description`, `poster`, `duration`) VALUES (NULL, 'World War Z', 'Zombies', 'http://fr.web.img6.acsta.net/c_215_290/medias/nmedia/18/94/54/41/20526204.jpg', '60')

-- Récupérer tous les noms de films :
SELECT films.title FROM films

-- Récupérer les utilisateurs sans doublons :
SELECT DISTINCT id, email, roles, password FROM user

-- Supprimer un film : 
DELETE FROM films WHERE films.id = 4

-- Mise à jour du nom d un film :
UPDATE films SET title = 'Harry potter' WHERE films.id = 5

-- Liste des films triés par le nom :
SELECT films.id, films.title, films.description, films.poster, films.poster FROM films ORDER BY films.title ASC

-- Liste des films sortis entre 2018 et 2019 :
SELECT films.id, films.title, films.release FROM films WHERE release BETWEEN '2018-01-01' AND '2019-12-31'

-- Liste des utilisateurs avec un email gmail :
SELECT user.email FROM user WHERE user.email LIKE '%@gmail.%'

-- Rajouter le champ pseudonyme à la table utilisateur :
ALTER TABLE user ADD pseudo VARCHAR(255)

-- Récupérer les films sorties il y a deux ans et avec le nom qui commence par un "l" :
SELECT films.id, films.title FROM films WHERE films.title LIKE 'i%' AND DATEDIFF(films.release, DATE_SUB(NOW(), INTERVAL 2 YEAR)) <=0

-- HAVING :
SELECT booking.user_id, COUNT(booking.screening_id) FROM booking GROUP BY booking.user_id HAVING COUNT(booking.screening_id) >= 2

-- Sous-requête :
SELECT films.title FROM films WHERE films.id in ( SELECT screenings.film_id_id FROM screenings )

-- Left Join :
SELECT * FROM user LEFT JOIN booking ON user.id = booking.user_id

-- Right Join : 
SELECT * FROM films RIGHT JOIN screenings ON films.id = screenings.film_id_id

-- Full Join :
SELECT * FROM room FULL JOIN screenings ON room.id = screenings.room_id_id


