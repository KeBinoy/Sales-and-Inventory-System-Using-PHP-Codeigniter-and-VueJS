Start Add modal-->
<modal v-if="addModal" @close="clearAll()">
    <h3 slot="head" >New Category</h3>
    <div slot="body" class="row">
        <div class="col-md-12">
            <div class="form-group">
                <strong>Category Name</strong>
                <input type="text" class="form-control" :class="{'is-invalid': formValidate.category_name}"  placeholder="Category Name"name="category_name" v-model="newCategory.category_name" autofocus="autofocus">

                <div class="has-text-danger" v-html="formValidate.category_name"> </div>
                
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>Category Description</strong>
                <input type="text" class="form-control"  placeholder="Category Description"name="category_description" v-model="newCategory.category_description">

                <!-- <div class="has-text-danger" v-html="formValidate.category_description"> </div> -->
                
            </div>
        </div>
    </div>
    <div slot="foot">
        <button class="btn btn-dark" @click="addCategory">Create</button>
    </div>
</modal>
<!--End Add modal-->

<!--Start Edit modal-->
<modal v-if="editModal" @close="clearAll()">
    <h3 slot="head" >Edit Category</h3>
    <div slot="body" class="row">
        <div class="col-md-12">
            <div class="form-group">
                <strong>Category Name</strong>
                <input type="text" class="form-control" :class="{'is-invalid': formValidate.category_name}"  placeholder="Category Name"name="category_name" v-model="chooseCategory.category_name" autofocus="autofocus">

                <div class="has-text-danger" v-html="formValidate.category_name"> </div>
                
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>Category Description</strong>
                <input type="text" class="form-control" placeholder="Category Description"name="category_description" v-model="chooseCategory.category_description">

                <!-- <div class="has-text-danger" v-html="formValidate.catDesc"> </div> -->
                
            </div>
        </div>
    </div>
    <div slot="foot">
        <button class="btn btn-dark" @click="updateCategory">Update</button>
    </div>
</modal>
<!--End Edit modal-->

<!--Start Read modal-->
<modal v-if="readModal" @close="clearAll()">
    <h3 slot="head" >Read Category</h3>
    <div slot="body" class="row">
        <div class="col-md-12">

           <!--  <dl>
                <dt>Category Name</dt>
                <dd>- {{chooseCategory.category_name}}</dd>
                <dt>Category Description</dt>
                <dd>- {{chooseCategory.category_description}}</dd>
            </dl>      -->

            <div class="col-md-12">
                <div class="form-group">
                    <strong>Category Name</strong>
                    <br/>
                    - {{chooseCategory.category_name}}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Category Description</strong>
                    <br/>
                    - {{chooseCategory.category_description}}                
                </div>
            </div>
        </div>
    </div>
    <div slot="foot">
        <button class="btn btn-dark" @click="editCategory">Update</button>
    </div>
</modal>
<!--End Read modal