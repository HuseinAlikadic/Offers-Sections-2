@extends('layouts.app')

@section('content')
<div class="container">
    <p>Section related data:</p>
    <br>
    <button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#addSections">
        Add section
    </button>
    <br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Order</th>
                <th>Published</th>
                <th>Is on front</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item,index) in section">
                <td>@{{item.name}}</td>
                <td>@{{item.slug}}</td>
                <td>@{{item.order}}</td>
                <td>@{{item.published}}</td>
                <td>@{{item.is_on_front}}</td>
                <td><i class="fas fa-edit" @click="editSection(index)"></i></td>
                <td><i class="fas fa-trash-alt" @click="deleteSection(index)"></i></td>
            </tr>
        </tbody>
    </table>
    <div class="modal" id="deleteSection">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Delete Offer</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <input type="hidden" name="id" :value="deleteSectionId">
                        <p>Are you sure you want to delete section <strong>@{{deleteSectionName}}. </strong> </p>
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
    name: 'Section',
    data() {
        return {
            section: <?=$section?>,
          
            deleteSectionName: null,
            deleteSectionId: null
        }
    },
    methods: {
        editSection: function(index) {

            $('#editOffer').modal('toggle');
        },
        deleteSection: function(index) {
            console.log(index);
            this.deleteSectionName = this.section[index].id;
            this.deleteSectionId = this.section[index].name;
            $('#deleteSection').modal('toggle');
        }

    },

})
</script>
@endsection