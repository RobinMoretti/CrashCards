
export default {
	async initWorkshop ({ commit }, payload) {
    let data;

    await axios.post(window.workshopBaseUrl + "/get" , {
      _token: document.querySelector('meta[name=csrf-token]').getAttribute('content'),
      headers: { 'content-type': 'multipart/form-data' } 
    })
    .then(response => {
        data = response.data;
        commit("setWorkshop", data);
    })
    .catch(e => {
      console.log(e)
    }) 
	},
  async setWorkshopProperty ({ commit, state }, payload) {
    var workshop =Object.assign({},  state.workshop);
    workshop[payload["property"]] = payload["content"];

    await axios.post(window.workshopBaseUrl + "/update" , {
      _token: document.querySelector('meta[name=csrf-token]').getAttribute('content'),
      headers: { 'content-type': 'multipart/form-data' },
      _data: workshop,
    })
    .then(response => {
        // data = response.data;
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
  async setWorkshopImage ({ commit, state }, payload) {
    var workshop =Object.assign({},  state.workshop);

    await axios.post(window.workshopBaseUrl + "/update/image", payload["formData"], {
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

