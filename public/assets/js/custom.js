jQuery.noConflict();
jQuery(document).ready(function($){
	
	"use strict";
	var Application = function () {
			
		return { init: init };

		var players = [];
		var rounds 	= 0;
		var winner 	= false;
		
		function init () {
			$('#next_turn').click(play_turn);
			$('#restart').click(create_game);
			create_game();
		}

		function create_game() {
			$.get('/create', function(res){
				if (res.code == 200) {
					$('#log_container').html('<p>'+res.payload.message+'</p>');
				} else {
					$('#log_container').html('<p>Erro ao criar a partida.</p>');
				}
			}, 'JSON').done(load_initiative);
		}

		function load_initiative() {
			$.get('/initiative', function(res){
				if (res.code == 200) {
					$('#log_container').append('<p>'+res.payload.message+'</p>');
				} else {
					$('#log_container').append('<p>Erro ao sortear initiativa.</p>');
				}
			}, 'JSON').done(load_stats);
		}

		function play_turn()
		{
			if (!Application.winner) {
				$.get('/attack', function(res){
					if (res.code == 200) {
						$('#log_container').append('<p>'+res.payload.message+'</p>');
					} else {
						$('#log_container').append('<p>Erro ao sortear initiativa.</p>');
					}
				}, 'JSON').done(load_stats);
			}
		}

		function endgame()
		{
			$('#log_container').append('<p>A Batalha terminou.</p>');
			$('#log_container').append('<p>'+Application.winner+' foi o vencedor.</p>');
		}

		function load_stats() {
			$.get('/state', function(res){
				if (res.code == 200) {
					//load data
					load_data(res.payload);
				} else {
					$('#log_container').append('<p>Erro ao carregar dados da partida.</p>');
				}
			}, 'JSON')
		}

		function get_next(){
			$.get('/attacker', function(res){
				if (res.code == 200) {
					$('#log_container').append('<p>'+res.payload.message+'</p>');
				} else {
					$('#log_container').append('<p>Erro ao carregar próximo atacante.</p>');
				}
			}, 'JSON');
		}

		function load_data(game_data)
		{
			Application.players = game_data.players;
			Application.rounds 	= game_data.rounds;
			Application.winner 	= game_data.winner;	

			update_players();

			if (!Application.winner)
			{
				get_next();
			}  else {
				endgame();
			}
			$("#log_container").animate({ scrollTop: $('#log_container').prop("scrollHeight")}, 1000);
		}

		function update_players()
		{
			var player1 = Application.players[1];
			var player2 = Application.players[2];

			$('#player1 .name').text(player1.name);
			$('#player1 .life').text(player1.life);
			$('#player1 .strength').text(player1.strength);
			$('#player1 .agility').text(player1.agility);
			$('#player1 #weapon .weapon_name').text(player1.weapon.name);
			$('#player1 #weapon .attack').text(player1.weapon.attack);
			$('#player1 #weapon .defense').text(player1.weapon.defense);
			$('#player1 #weapon .damage').text('1D' + player1.weapon.damage.faces);

			$('#player2 .name').text(player2.name);
			$('#player2 .life').text(player2.life);
			$('#player2 .strength').text(player2.strength);
			$('#player2 .agility').text(player2.agility);
			$('#player2 #weapon .weapon_name').text(player2.weapon.name);
			$('#player2 #weapon .attack').text(player2.weapon.attack);
			$('#player2 #weapon .defense').text(player2.weapon.defense);
			$('#player2 #weapon .damage').text('1D' + player2.weapon.damage.faces);
		}
		
	}();
	Application.init();
});