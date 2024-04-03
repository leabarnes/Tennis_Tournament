<html>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body>
        <h3>Simulate Tournament Listed Players</h3><br/>
        <form action="">
            <p>Player List (JSON)</p>
            <textarea id="player_list" style="width: 795px; height: 134px;">
[{"name":"Test 0","gender":"M","handicap":24,"extra":{"force":9,"velocity":4,"reaction":0}},
{"name":"Test 1","gender":"M","handicap":11,"extra":{"force":10,"velocity":8,"reaction":0}},
{"name":"Test 2","gender":"M","handicap":74,"extra":{"force":3,"velocity":1,"reaction":0}},
{"name":"Test 3","gender":"M","handicap":80,"extra":{"force":2,"velocity":3,"reaction":0}},
{"name":"Test 4","gender":"M","handicap":99,"extra":{"force":5,"velocity":5,"reaction":0}},
{"name":"Test 5","gender":"M","handicap":97,"extra":{"force":1,"velocity":10,"reaction":0}},
{"name":"Test 6","gender":"M","handicap":90,"extra":{"force":3,"velocity":8,"reaction":0}},
{"name":"Test 7","gender":"M","handicap":64,"extra":{"force":10,"velocity":7,"reaction":0}}]</textarea>
        </form><br/>
        <a href="#" onclick="simulateList()">Simulate</a><br/>

        <h3>Simulate Tournament</h3><br/>
        <p>Num. Players</p>
        <input id="num_players">
        <p>Gender</p>
        <input id="gender">
        <p>Random <input id="random" type="checkbox"></p>
        <a  href="#" onclick="simulate()">Simulate </a><br/>
        
        <h3>Find Tournament</h3><br/>
        <p>Field</p>
        <select id="search_field">
            <option value="id">ID</option>
            <option value="status">Status</option>
            <option value="date">Date</option>
            <option value="gender">Gender</option>
        </select>
        <p>Condition</p>
        <select id="search_condition">
            <option value="lower">Lower Than</option>
            <option value="equal">Equal To</option>
            <option value="higher">Higher Than</option>
        </select>
        <p>Value <input id="search_value"></p>
        <a  href="#" onclick="find()">Find </a><br/>
        <div id="find_results"></div>
    </body>
    <script>
        function simulateList(){
            var list = JSON.parse($("#player_list").val());
            $.ajax({
                method: "POST",
                url: "/api/simulate.php",
                data: { player_list: list }
            }).done(function( msg ) {
                alert( "Result: " + msg );
            });
        }
        function simulate(){
            var num_players = $("#num_players").val();
            var gender = $("#gender").val();
            var random = $("#random").checked;
            $.ajax({
                method: "POST",
                url: "/api/simulate.php",
                data: { num_players: num_players, gender: gender, random: random }
            }).done(function( msg ) {
                alert( "Result: " + msg );
            });
        }
        function find(){
            var search_field = $("#search_field").val();
            var search_condition = $("#search_condition").val();
            var search_value = $("#search_value").val();
            $.ajax({
                method: "POST",
                url: "/api/find.php",
                data: { search_field: search_field, search_condition: search_condition, search_value: search_value }
            }).done(function( data ) {
                $("#find_results").append(data);
            });
        }
    </script>
</html>