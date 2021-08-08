@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
    <div class="alert alert-success sakriPoruku" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <div>
     
        <div class="input-group mb-3">
            <input
                type="text"
                class="form-control"
                placeholder="Search"
                v-model="pretrazi" 
            />
            <div class="input-group-append">
                <button class="btn btn-success"  @click="searchOfferByTitle()" >
                    Search
                </button>
            </div>
        </div> 
    </div>
   

  
    <p> Display data for offers</p>
    <button v-show="isAdmin=='1'" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addOffer">Add
        Offer</button>
        <br>
        <br>
        <div v-show="spinner==true" class="spinner-border text-primary"></div>
    <table v-show="spinner==false" class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Slug</th>
                <th>Published at</th>
                <th>Published</th>
                <th>Introduction</th>
                <th>Description</th>
                <th>Author</th>
                <th>Section</th>
                <th>Image</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item,index) in offer">
                <td>@{{item.title}}</td>
                <td>@{{item.slug}}</td>
                <td>@{{item.published_at}}</td>
                <td> @{{item.published==0?'No':'Yes'}}</td>
                <td>@{{item.introduction}}</td>
                <td>@{{item.description}}</td>
                <td>@{{item.author}}</td>
                <td>@{{item.sectionNama}}</td>
                <td>@{{item.image}}</td>
                <td><i class="fas fa-edit" @click="editOffer(index)"></i></td>
                <td><i v-show="isAdmin=='1'||item.authorId==isCreateOffer" class="fas fa-trash-alt"
                        @click="deleteOffer(index)"></i></td>
            </tr>

        </tbody>
    </table>

    <!-- Kreiranje nove ponude -->
    <div class="modal" id="addOffer">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Offer</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="api/add-offer" method="POST" >
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usr">Title:</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                       
                        <div class="form-group">
                            <label for="usr">Published at:</label>
                            <input type="date" class="form-control" name="published_at" required>
                        </div>
                        <p>Published</p>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" value="0" name="published" required>No
                            </label>

                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" value="1" name="published" required>Yes
                            </label>

                        </div>
                        <div class="form-group">
                            <label for="usr">Introduction:</label>
                            <input type="text" class="form-control" name="introduction" required>
                        </div>
                        <div class="form-group">
                            <label for="usr">Description:</label>
                            <input type="text" class="form-control" name="description" required>
                        </div>

                        <div class="form-group">
                            <label for="sel1">Select author:</label>
                            <select class="form-control" name="author_id" required>
                                <option value="">Select</option>
                                <option :value="item.id" v-for="item in user">@{{item.name}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sel1">Select section:</label>
                            <select class="form-control" name="section_id" required>
                                <option value="">Select</option>
                                <option :value="item.id" v-for="item in section">@{{item.name}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control" name="image" required>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
    <!-- Editovanje postojeće ponude -->
    <div class="modal" id="editOffer">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Offer</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="api/edit-offer" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <input type="hidden" v-model="editOfferArray.offerId" name="id">
                        <div class="form-group">
                            <label for="usr">Title:</label>
                            <input type="text" class="form-control" v-model="editOfferArray.title" name="title"
                                required>
                        </div>
                        
                        <div class="form-group">
                            <label for="usr">Published at:</label>
                            <input type="datetime" class="form-control" v-model="editOfferArray.published_at"
                                name="published_at" required>
                        </div>
                        <p>Published</p>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" v-model="editOfferArray.published"
                                    value="0" name="published" required>No
                            </label>

                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" v-model="editOfferArray.published"
                                    value="1" name="published" required>Yes
                            </label>

                        </div>
                        <div class="form-group">
                            <label for="usr">Introduction:</label>
                            <input type="text" class="form-control" v-model="editOfferArray.introduction"
                                name="introduction" required>
                        </div>
                        <div class="form-group">
                            <label for="usr">Description:</label>
                            <input type="text" class="form-control" v-model="editOfferArray.description"
                                name="description" required>
                        </div>

                        <div class="form-group">
                            <label for="sel1">Select author:</label>
                            <select class="form-control" name="author_id" required v-model="editOfferArray.authorId">
                                <option value="">Select</option>
                                <option :value="item.id" v-for="item in user">@{{item.name}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sel1">Select section:</label>
                            <select class="form-control" name="section_id" required v-model="editOfferArray.sectionId">
                                <option value="">Select</option>
                                <option :value="item.id" v-for="item in section">@{{item.name}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="usr">Image:</label>
                            <input type="text" class="form-control" :value="editOfferArray.image" name="image" required>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
    <!-- Modal za potvrdu brisanja -->
    <div class="modal" id="deleteOffer">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Delete Offer</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('deleteOffer')}}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <input type="hidden" name="id" :value="deleteOfferId">
                        <p>Are you sure you want to delete offer <strong>@{{deleteOfferName}}. </strong> </p>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
@section('vue-scripts')
<script>
const app = new Vue({
    el: '#app',
    name: 'Home',
    data() {
        return {
            offer: <?=$offer?>,
            section: <?=$section?>,
            user: <?=$user?>,
            isAdmin: <?=$isAdmin?>,
            editOfferArray: [],
            deleteOfferId: null,
            deleteOfferName: null,
            isCreateOffer: <?=$isCreateOffer?>,
            pretrazi:null,
            spinner:false

        
        }
    },
    methods: {
        editOffer: function(index) {
            this.editOfferArray = this.offer[index];
            $('#editOffer').modal('toggle');
        },
        deleteOffer: function(index) {
            this.deleteOfferId = this.offer[index].offerId;
            console.log(this.deleteOfferId);
            this.deleteOfferName = this.offer[index].title;
            $('#deleteOffer').modal('toggle');
        },
        searchOfferByTitle:function(){
           this.spinner=true;
            axios.get('/api/search-offer',{ params:{
                rezultat: this.pretrazi,
                mojaVar: 'ggggg'
            }})
                .then((response)=> {
                    
                    this.offer = response.data;
                    this.spinner=false
                }
            )
        }


    },
    mounted() {
        setTimeout(function() {
            $('.sakriPoruku').hide();
        }, 1000);

    },


});
</script>
@endsection