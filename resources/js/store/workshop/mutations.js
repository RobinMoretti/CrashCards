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
}

// function setWorkshop (state, data) {
// 	state.workshop = data;
// }