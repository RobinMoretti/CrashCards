// import Vue from 'vue'

export default {
	setWorkshop (state, data) {
		state.workshop = data;
	},
	setAvailableDecks (state, data) {
		state.availableDecks = data;
	},
	setWorkshopDeck (state, data) {
		state.workshop.deck = data;
		state.workshop.deck_id = data.id;
	},
	setUser (state, data) {
		state.user = data;
	},
	setAuthorRights (state, data) {
		state.isAuthorOfWorkshop = data;
	},
	setTeams (state, data) {

		for (var i = 0; i < data.length; i++) {
			console.log(data[i])
			for (var u = 0; u < data[i].fake_players.length; u++) {
				data[i].fake_players[u].fakeUser = true;
				data[i].players.push(data[i].fake_players[u]);
			}
		}

		state.teams = data;
	},
	setTeam (state, data) {
		var teamIndex = state.teams.findIndex(item => item.id === data.id);
		state.teams.splice(teamIndex, 1, data)
	},
	addNewTeam (state, data) {
		state.teams.push(data);
	},
	setSelectedTeam (state, data) {
		state.selectedTeam = data;
	},
	deleteSelectedTeam (state, data) {
		var teamIndex = state.teams.findIndex(item => item.id === data.id);
		state.teams.splice(teamIndex, 1);
	},
	setParticipants (state, data) {
		state.participants = data;
	},
	setFakePlayers (state, data) {
		for (var i = 0; i < data.length; i++) {
			data[i].fakePlayer = true;
		}
		state.fakePlayers = data;
	},
	addPlayerToTeam (state, data) {
		console.log(data)
		var team = data["team"];
		var player = data.player;
		var teamIndex = state.teams.findIndex(item => item.id === team.id);

		state.teams[teamIndex].players.push(player);

		if(player.fakeUser){
			state.participants.push(player);
		}
	},
	removePlayerToTeam (state, data) {
		var team = data["team"];
		var player = data["player"];
		var teamIndex = state.teams.findIndex(item => item.id === team.id);
		var playerIndex = state.teams[teamIndex].players.findIndex(item => item.id === player.id && item.username === player.username);
		
		state.teams[teamIndex].players.splice(playerIndex, 1);

		if(player.fakeUser){
			var indexToRemove = state.participants.findIndex(item => item.id === player.id && item.username === player.username);
			state.participants.splice(indexToRemove, 1);
		}
	},
}

// function setWorkshop (state, data) {
// 	state.workshop = data;
// }