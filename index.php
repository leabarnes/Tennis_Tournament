<html>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body>
        <h3>Simulate Tournament Listed Players</h3><br/>
        <form action="">
            <p>Player List (JSON)</p>
            <textarea id="player_list" style="width: 632px; height: 152px;">
{"name":"Test 0","gender":"M","handicap":24,"force":9,"velocity":4,"reaction":0},
{"name":"Test 1","gender":"M","handicap":11,"force":10,"velocity":8,"reaction":0},
{"name":"Test 2","gender":"M","handicap":74,"force":3,"velocity":1,"reaction":0},
{"name":"Test 3","gender":"M","handicap":80,"force":2,"velocity":3,"reaction":0},
{"name":"Test 4","gender":"M","handicap":99,"force":5,"velocity":5,"reaction":0},
{"name":"Test 5","gender":"M","handicap":97,"force":1,"velocity":10,"reaction":0},
{"name":"Test 6","gender":"M","handicap":90,"force":3,"velocity":8,"reaction":0},
{"name":"Test 7","gender":"M","handicap":64,"force":10,"velocity":7,"reaction":0}
            </textarea>
        </form><br/>
        <a href="#" onclick="simulateList()">Simulate</a><br/>

        <h3>Simulate Tournament</h3><br/>
        <p>Num. Players</p>
        <input id="num_players">
        <p>Gender</p>
        <input id="gender">
        <p>Random <input id="random" type="checkbox"></p>
        <a  href="#" onclick="simulate()">Simulate </a><br/>
    </body>
    <script>
        function simulateList(){
            var list = $("#player_list").val();
            list = "\""+list.replace(/"/g, "'")+"\"";
            $.ajax({
                method: "POST",
                url: "/api/simulate.php",
                data: { player_list: list }
            }).done(function( msg ) {
                alert( "Winner: " + msg );
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
                alert( "Winner: " + msg );
            });
        }
    </script>
</html>