
import EventBus from '../../event-bus';

export default {
	async initWorkshop ({ commit, state }, payload) {
    let data;
    console.log('initial workshop')

    await axios.post( state.workshopBaseUrl + "/get" , {
      _token: document.querySelector('meta[name=csrf-token]').getAttribute('content'),
      headers: { 'content-type': 'multipart/form-data' } 
    })
    .then(response => {
        data = response.data;

        commit("setWorkshop", data[0]);
        EventBus.$emit('workshop-initied');

        commit("setAvailableDecks", data[1]);

        commit("setUser", data[2]);

        commit("setAuthorRights", Boolean(data[3]));

        commit("setTeams", data[4]);

    })
    .catch(e => {
      console.log(e)
    }) 
	},
  async setWorkshopProperty ({ commit, state }, payload) {

    var workshop =Object.assign({},  state.workshop);
    workshop[payload["property"]] = payload["content"];

    await axios.post(state.workshopBaseUrl + "/update" , {
      _token: document.querySelector('meta[name=csrf-token]').getAttribute('content'),
      _data: workshop,
    })
    .then(response => {
        // data = response.data;
      return new Promise((resolve, reject) => {
        console.log(workshop)
        commit("setWorkshop", workshop);
        resolve()
      })

    })
    .catch(e => {
      console.log(e)

      return new Promise((resolve, reject) => {
        reject()
      })

    }) 
  },
  async setWorkshopImage ({ commit, state }, payload) {
    var workshop =Object.assign({},  state.workshop);

    await axios.post(state.workshopBaseUrl + "/update/image", payload["formData"], {
      _token: document.querySelector('meta[name=csrf-token]').getAttribute('content'),
      headers: { 'content-type': 'multipart/form-data' } 
    })
    .then(response => {
        workshop.image_header = response.data;
        console.log(response.data)
        return new Promise((resolve, reject) => {
          commit("setWorkshop", workshop);
          resolve()
        })
    })
    .catch(e => {
      console.log(e)
      return new Promise((resolve, reject) => {
        reject()
      })
    })
  },
  async setWorkshopDeck ({ commit, state }, payload) {
    await axios.post(state.workshopBaseUrl + "/set/deck", {
      _token: document.querySelector('meta[name=csrf-token]').getAttribute('content'),
      _data: payload["deck"].id
    })
    .then(response => {
        console.log(response.data)
        var deck = response.data;
        return new Promise((resolve, reject) => {
          commit("setWorkshopDeck", deck);
          resolve()
        })
    })
    .catch(e => {
      console.log(e)
      return new Promise((resolve, reject) => {
        reject()
      })
    })
  },
  async createTeam ({ commit, state }, payload) {
    await axios.post(state.workshopBaseUrl + "/team/create", {
      _token: document.querySelector('meta[name=csrf-token]').getAttribute('content'),
    })
    .then(response => {
        console.log(response.data)
        var team = response.data;
        return new Promise((resolve, reject) => {
          commit("addNewTeam", team);
          resolve()
        })
    })
    .catch(e => {
      console.log(e)
      return new Promise((resolve, reject) => {
        reject()
      })
    })
  },
  toggleSelectedTeam ({ commit, state }, team) {
    if(state.selectedTeam == team){
      commit("setSelectedTeam", {});
    }else{
      commit("setSelectedTeam", team);
    }
  },
  async setTeamProperty ({ commit, state }, payload) {

    var team = Object.assign({},  state.selectedTeam);


    team[payload["property"]] = payload["content"];

    await axios.post(state.workshopBaseUrl + "/team/" + team.id + "/update", {
      _token: document.querySelector('meta[name=csrf-token]').getAttribute('content'),
      _data: team,
    })
    .then(response => {
        // data = response.data;
      return new Promise((resolve, reject) => {
        console.log(team)

        commit("setTeam", team);
        commit("setSelectedTeam", team);
        resolve()
      })

    })
    .catch(e => {
      console.log(e)

      return new Promise((resolve, reject) => {
        reject()
      })

    }) 
  },
  async deleteSelectedTeam ({ commit, state }, team) {
    // ajouter si leader
    if(state.user.id == state.workshop.author.id){

      await axios.post(state.workshopBaseUrl + "/team/" + team.id +"/delete", {
        _token: document.querySelector('meta[name=csrf-token]').getAttribute('content'),
      })
      .then(response => {
          console.log(response.data)
          if(response.data){
            return new Promise((resolve, reject) => {
              commit("deleteSelectedTeam", team);
              resolve()
            })
          }
      })
      .catch(e => {
        console.log(e)
        return new Promise((resolve, reject) => {
          reject()
        })
      })
    }
  },
}

	// async initWorkshop ({ commit }, payload) {
	// 	let data;

 //        await axios.post(window.getWorkshopObjRoute, {
 //          _token: document.querySelector('meta[name=csrf-token]').getAttribute('content'),
 //          headers: { 'content-type': 'multipart/form-data' } 
 //        })
 //        .then(response => {
 //            data = response.data;
 //        })
 //        .catch(e => {
 //          console.log(e)
 //        }) 

 //  		commit("setWorkshop", data);
	// },

