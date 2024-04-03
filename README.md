Tennis Tournament Simulation
You can check the application in http://3.144.130.245/
API Endpoints http://3.144.130.245/api/find.php & http://3.144.130.245/api/simulate.php

http://3.144.130.245/api/find.php recieve 3 params by POST
search_field -> Field of the tournament search (could be: id, status, gender or date)
search_condition -> Field of the condition to search (could be: lower, equal, higher but only works for date, for the rest will be always equal)
search_value -> Field for the reference value (int/string)

http://3.144.130.245/api/simulate.php recieve 1 or 3 params
1 param -> player_list: An array with the players list (example in index)
3 param -> num_players: Amount of players to participate in the tournament
           gender: Desired gender for the tournament (M or F)
           random: true/false


All the code should work in a simple LAMP but you must set the DB using the db_dump.sql

Side note: Added composer to use PHPUnit, but no Test was created so is not used right now
