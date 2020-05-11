<template>
  <div>
    <div>
</div>
    <div
      class="col-xs-12 col-sm-12 col-md-12 col-lg-6 offset-lg-3 mt-5"
      v-for="post in posts"
      :key="post.id"
    >
      <div class="card">
        <div class="card-header">
          <div class="nav nav-pills card-header-pills">
            <li class="nav-link">
              <a :href="'profile/' + post.user.id">
                <img alt class="rounded-circle post-avatar" :src="post.user.profile.image_path" />
              </a>
            </li>
            <li class="nav-link">
              <a :href="'profile/' + post.user.id">
                <strong>{{post.user.username}}</strong>
              </a>
            </li>
            <li class="nav-link ml-auto">
              <a href="#">
                <i class="fas fa-ellipsis-v"></i>
              </a>
            </li>
          </div>
          </div>
          <div class="card-body">
            <a :href="'p/'+ post.id">
              <img class="card-img-top w-100" alt="Card image cap" :src="post.image_path" />
            </a>
          </div>
          <div class="card-footer bg-transparent">
            <a href="#" class="mr-2">
              <i class="far fa-heart fa-lg" v-bind:class="{liked: userLikes.includes(post.id)}" @click.prevent="likeThePost(post.id)"></i>
            </a>
            <a :href="'p/' + post.id" class="mr-2">
              <i class="far fa-comment fa-lg"></i>
            </a>
            <b-link v-b-modal.share><i class="far fa-paper-plane fa-lg"></i></b-link>
            <b-modal :id="'share'">share</b-modal>
            <a href="#" class="float-right">
              <i class="far fa-bookmark fa-lg"></i>
            </a>
          
              
                <div v-if="post.likers.length > 0">
                <b-link v-b-modal="modalId(post.id)"><strong>{{post.likers.length}} likes</strong></b-link>
                <b-modal :id="'modal' + post.id" centered title="Likers" hide-header hide-footer>
                  <div class="media" centered v-for="liker in post.likers" :key="liker.id">
                    <a class="mt-1" :href="'profile/' + liker.id"><img  alt="" class="rounded-circle post-avatar mr-1 mt-1" :src="liker.profile.image_path"> </a>
                      <div class="media-body mt-2 ml-2">
                         <a :href="'profile/' + liker.id">
                          <strong>{{liker.username}}</strong>  
                         </a> 
                         <br />
                            <span class="text-secondary">{{liker.name}}</span> 
                      </div>
                  </div>
                </b-modal>
                </div>
                <div v-else><strong>0 likes</strong></div>

              <br />
              <!-- <strong v-show="userLikes.includes(post.id) && userLikes.length > 1">You and </strong><strong>{{post.likers.length -1}} other like this post</strong> -->
            
            <div class="comments">
              <div class="media" v-for="comment in post.comments.slice(-3)" :key="comment.id">
                <!-- <a :href="'profile/' + comment.user.id"><img  alt="" class="rounded-circle post-avatar mr-1 mt-1" :src="comment.user.profile.image_path"> </a> -->
                <div class="media-body mt-2">
                  <a :href="'profile/' + comment.user.id">
                    <strong>{{comment.user.username}}</strong>
                  </a>
                  {{comment.body}}
                </div>
              </div>
              <p class="text-center text-secondary">
                <a :href="'p/' + post.id">View all {{post.comments.length}} comments</a>
              </p>
            </div>
          </div>
          <div class="card-footer">
            <div class="input-group mb-3">
              <input
                v-model="newComment"
                type="text"
                class="form-control"
                placeholder="Add a comment..."
                aria-label="Post"
                aria-describedby="basic-addon2"
              />
              <div class="input-group-append">
                <button :disabled="!newComment" @click.prevent="addComment(post.id)" class="btn btn-primary" type="button">Post</button>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    userId: null
  },

  data() {
    return {
      posts: null,
      newComment: null,
      isLoading: null,
      userLikes: null
    };
  },
  
  methods: {

       modalId(i) {
      return 'modal' + i;
     },


    addComment(postID) {


       if(!this.newComment) {
         return 
       }
     

      let body = {
        post_id: postID,
        user_id: this.userId,
        comment: this.newComment
      };

      // console.log("commenting on post" + this.postID + " " + this.newComment);
      
      axios({
        method: "post",
        url: "/api/comments/",
        data: body
      })
        .then(response => {
          // console.log(response);
          this.newComment = "";
          this.getPosts();
        })
        .catch(errors => {
          console.log(errors);
        });
    },
    getPosts() {
      this.isLoading = true;
      axios
        .get("/api/posts")
        .then(response => {
          // console.log('the response is ' + JSON.stringify(response.data));
          this.posts = response.data;
          // console.log("Vue posts object " + this.posts);
          this.isLoading = false;
          this.getCurrentUserLikes();
        })
        .catch(errors => {
          console.log("Could`t fetch the data -> " + errors);
        });
    },
    getCurrentUserLikes() {
      this.userLikes = [];
      this.posts.forEach(post => {

         post.likers.forEach(liker => {

           if(liker.id == this.userId) {
              this.userLikes.push(post.id)
           }

         });

      })

      // console.log('MY LIKES', this.userLikes);
       
    },
    likeThePost(post) {

      let body = {
        'post_id': post,
        'user_id': this.userId
      }

      axios({
        method: "post",
        url: "/api/likes/",
        data: body
      })

      .then(response => {

        // console.log(response);
        this.getPosts();
      })

      .catch(error => {

        console.log(error);
      })


      
    },
    likersModal(postID) {

      alert('show likers');

    },
    shareModal(postID) {
      alert('share modal');
    }


  },
  created() {
    this.getPosts();
  }
};
</script>

<style>
 .liked {
   color: red;
 }
</style>