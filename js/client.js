(function() {

    //dbtkn 
    const DBTKN = "61f032957e55272295017110";
    const COLLCTN = "61f038b8f701f4600006aea4";
  
    //get db instance 
    const db = new restdb(DBTKN, this.dbOptions);
  
    //listen for changes
    db.votes.on("PUT", function(error, eventdata) {
      console.log('Data updated')
    });
  
    //get the button elements
    let voteBtns = document.querySelectorAll("._vote-btn");
  
    //add click event listeners to the btn el
    voteBtns.forEach((btn)=> {
  
      btn.addEventListener("click", ()=> {
        
        if(localStorage.voted) {
          alert("You can only vote once!");
          return;
        }
        
        let type = btn.getAttribute("data-type");
  
        toggleReqLoading();
  
        if(type == "upvote") {
          //TODO: Call upvote
          updateVotes("upvote");
        } else {
          //TODO: Call downvote
          updateVotes("downvote");
        }
  
      });
  
    });
  
  
    //get & render the current votes from the db
    let getRenderVotes = () => {
      db.votes.getById(COLLCTN, (err, res) => {
        if(!err) {
          let upvotes = document.querySelector("#_upvotes");
          let downvotes = document.querySelector("#_downvotes");
  
          upvotes.innerHTML = res.upvote;
          downvotes.innerHTML = res.downvote;
        }
      });
    }
  
  
    //update votes
    let updateVotes = (type) => {
  
      //get the current votes
      db.votes.getById(COLLCTN, (err, res) => {
        if(!err) {
          let upvotes = res.upvote;
          let downvotes = res.downvote
  
          if(type == "upvote") {
            let newVotes = upvotes + 1;
            xhrReq({"upvote":newVotes}, "upvote");
          } else {
            let newVotes = downvotes + 1;
            xhrReq({"downvote":newVotes}, "downvote");          
          }
  
        }
      });
  
    };
  
    //toggleReqLoading
    let toggleReqLoading = () => {
      let b = document.querySelector("body");
  
      if(b.classList.contains("loading")) {
        b.classList.remove("loading");
      } else {
        b.classList.add("loading");
      }
  
    };
  
    let hasUserVoted = () => {
  
      if(localStorage.voted) {
        if(localStorage.voted == "upvote") {
          document.querySelector("[data-type='downvote']").classList.add("voted");
          document.querySelector("[data-type='upvote']").classList.add("voted");
          document.querySelector("[data-type='upvote']").classList.add("voted-user");
        } else {
          document.querySelector("[data-type='upvote']").classList.add("voted");
          document.querySelector("[data-type='downvote']").classList.add("voted");
          document.querySelector("[data-type='downvote']").classList.add("voted-user");
        }
      }
  
    };
  
    //xhrReq
    let xhrReq = (payload, type) => {
      let self = this;
      var data = JSON.stringify(payload);
  
      var xhr = new XMLHttpRequest();
      xhr.withCredentials = true;
  
      xhr.addEventListener("readystatechange", function () {
        if (this.readyState === 4) {
          localStorage.voted = type;
          hasUserVoted();
          getRenderVotes();
          toggleReqLoading();
        }
      });
  
      xhr.open("PUT", `https://voting-ed9b.restdb.io/rest/votes/${COLLCTN}`);
      xhr.setRequestHeader("content-type", "application/json");
      xhr.setRequestHeader("x-apikey", DBTKN);
      xhr.setRequestHeader("cache-control", "no-cache");
  
      xhr.send(data);
    };
  
    hasUserVoted();
    
    getRenderVotes();
  
  })()