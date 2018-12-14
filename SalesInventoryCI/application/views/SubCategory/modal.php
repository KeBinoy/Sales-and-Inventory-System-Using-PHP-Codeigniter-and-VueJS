<!--Start Add modal-->
<modal v-if="addModal" @close="clearAll()">
    <h3 slot="head" >New Sub Category</h3>
    <div slot="body" class="row">
        <div class="col-md-12">
            <div class="form-group">
                <strong>Sub Category Name</strong>
                <input type="text" class="form-control" :class="{'is-invalid': formValidate.sub_category_name}"  placeholder="Sub Category Name" name="sub_category_name" v-model="newSubCategory.sub_category_name" autofocus="autofocus">

                <div class="has-text-danger" v-html="formValidate.sub_category_name"> </div>
                
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <strong>Category Name</strong>
                <select v-model="newSubCategory.category_id" class="form-control" name="category_id" :class="{'is-invalid': formValidate.category_id}" >
                    <option  disabled value="">
                    --Select Category--
                  </option>
                  <option v-for="category in categories" v-bind:value="category.category_id">
                    {{ category.category_name }}
                  </option>
                </select>
                <!-- <span>Selected: {{ selected }}</span> -->

                <div class="has-text-danger" v-html="formValidate.category_id"> </div>
                
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>Sub Category Description</strong>
                <input type="text" class="form-control"  placeholder="Sub Category Description"name="sub_category_description" v-model="newSubCategory.sub_category_description">

                <!-- <div class="has-text-danger" v-html="formValidate.sub_category_description"> </div> -->
                
            </div>
        </div>
    </div>
    <div slot="foot">
        <button class="btn btn-dark" @click="addSubCategory">Create</button>
    </div>
</modal>
<!--End Add modal-->

<!--Start Edit modal-->
<modal v-if="editModal" @close="clearAll()">
    <h3 slot="head" >Edit Sub Category</h3>
    <div slot="body" class="row">
        <div class="col-md-12">
            <div class="form-group">
                <strong>Sub Category Name</strong>
                <input type="text" class="form-control" :class="{'is-invalid': formValidate.sub_category_name}"  placeholder="Sub Category Name" name="sub_category_name" v-model="chooseSubCategory.sub_category_name" autofocus="autofocus">

                <div class="has-text-danger" v-html="formValidate.sub_category_name"> </div>
                
            </div>
        </div>
         <div class="col-md-12">
            <div class="form-group">
                <strong>Category Name</strong>
                <select v-model="chooseSubCategory.category_id" class="form-control" name="category_id" :class="{'is-invalid': formValidate.category_id}" >
                    <option  disabled value="">
                    --Select Category--
                  </option>
                  <option v-for="category in categories" v-bind:value="category.category_id">
                    {{ category.category_name }}
                  </option>
                </select>
                <div class="has-text-danger" v-html="formValidate.category_id"> </div>
                
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>Sub Category Description</strong>
                <input type="text" class="form-control" :class="{'is-invalid': formValidate.sub_category_description}"  placeholder="Sub Category Description"name="sub_category_description" v-model="chooseSubCategory.sub_category_description">

                <div class="has-text-danger" v-html="formValidate.sub_category_description"> </div>
                
            </div>
        </div>
    </div>
    <div slot="foot">
        <button class="btn btn-dark" @click="updateSubCategory">Update</button>
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
                    <strong>Sub Category Name</strong>
                    <br/>
                    - {{chooseSubCategory.sub_category_name}}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Category Name</strong>
                    <br/>
                    - {{chooseSubCategory.category_name}}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Sub Category Description</strong>
                    <br/>
                    - {{chooseSubCategory.sub_category_description}}                
                </div>
            </div>
        </div>
    </div>
    <div slot="foot">
        <button class="btn btn-dark" @click="editSubCategory">Update</button>
    </div>
</modal>
<!--End Read modal-->