
<div class="container-fluid" id="appCategory">

	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="<?php echo base_url(); ?>Dashboard">Dashboard</a>
		</li>
		<li class="breadcrumb-item active">Category</li>
	</ol>
	

	<!-- Content-->
	<div class="card mb-12">
		<div class="card-header headBtn">
			<label class="headLabelBtn">
				<i class="fas fa-table"></i>
				Category List
			</label>
			
		</div>
		<div class="card-body">
			<transition
			enter-active-class="animated fadeInLeft"
			leave-active-class="animated fadeOutRight">
			<div class="notification is-success text-center px-5 top-middle" v-if="successMSG" @click="successMSG = false">{{successMSG}}</div>
		</transition>
		<div class="row">
			<div class="col-sm-7">
				<label><a class="btn btn-success btnRight" href="#" @click="addModal= true">New Category</a></label>
				<!-- <button class="btn btn-default" @click="addModal= true">Add</button> -->
			</div>
			<div class="col-sm-5">
				<input placeholder="Seach Category Name" type="search" class="form-control" v-model="search.text" @keyup="searchCategory" name="search">
				<!-- <input placeholder="Search"type="search" class="form-control" v-model="search.text" @keyup="searchUser" name="search"> -->
			</div>
		</div>
		
		<br/>
		<div class="table-responsive">
			<table class="table table-bordered table-hover" width="95%" cellspacing="0">
				<thead class="thead-light">
					<tr>
						<th class="iconClick" @click="sortBy('category_id')">#</th>
						<th class="iconClick" @click="sortBy('category_name')">Name</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

					<tr v-for="category in categories" class="table-default">
						<td>{{category.category_id}}</td>
						<td>{{category.category_name}}</td>
						<td>{{category.category_description}}</td>
						<td align="center">
							<i class="fas fa-fw fa-eye iconClick" aria-hidden="true" @click="readModal = true; selectCategory(category)" ></i> | 
							<i class="fa fa-edit iconClick" aria-hidden="true" @click="editModal = true; selectCategory(category)"></i>
						</td>
					</tr>
					<tr v-if="emptyResult">
						<td colspan="9" rowspan="4" class="text-center h1">No Record Found</td>
					</tr>
				</tbody>
			</table>
			<pagination
			:current_page="currentPage"
			:row_count_page="rowCountPage"
			@page-update="pageUpdate"
			:total_records="totalCategories"
			:page_range="pageRange"
			>
		</pagination>
		<br/>
	</div>
</div>
</div>

<!-- <div class="text-center"><p><?php echo $links; ?></p></div> -->


<!-- Add Modal-->
<!-- <div v-if="addModal" class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Enter New Category</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">

				<div class="form-group">
					<div class="form-label-group">
						<input type="text"  id="inputName" class="form-control" :class="{'is-invalid': formValidate.catName}"  placeholder="Category Name"name="catName" v-model="newCategory.catName" autofocus="autofocus">

						<div class="has-text-danger" v-html="formValidate.catName"> </div>
						<label for="inputName">Category Name</label>
					</div>
				</div>
				<div class="form-group">
					<div class="form-label-group">
						<input type="text"  id="inputDescription" class="form-control" :class="{'is-invalid': formValidate.catDesc}"  placeholder="Category Description"name="catDesc" v-model="newCategory.catDesc" autofocus="autofocus">

						<div class="has-text-danger" v-html="formValidate.catDesc"> </div>
						<label for="inputDescription">Category Description</label>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<a class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</a>
				<button class="btn btn-primary"  data-dismiss="modal" @click="addCategory">Submit</button>
			</div>
		</div>
	</div>
</div> -->
<!--- /.Add Modal -->

<!-- Start Edit Modal-->
<!-- <div v-if="editModal" class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">

				<div class="form-group">
					<div class="form-label-group">
						<input type="text"  id="inputName" class="form-control" :class="{'is-invalid': formValidate.catName}"  placeholder="Category Name"name="catName" v-model="chooseCategory.category_name" autofocus="autofocus">

						<div class="has-text-danger" v-html="formValidate.catName"> </div>
						<label for="inputName">Category Name</label>
					</div>
				</div>
				<div class="form-group">
					<div class="form-label-group">
						<input type="text"  id="inputDescription" class="form-control" :class="{'is-invalid': formValidate.catDesc}"  placeholder="Category Description"name="catDesc" v-model="chooseCategory.category_description" autofocus="autofocus">

						<div class="has-text-danger" v-html="formValidate.catDesc"> </div>
						<label for="inputDescription">Category Description</label>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<a class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</a>
				<button class="btn btn-primary"  data-dismiss="modal" @click="addCategory">Submit</button>
			</div>
		</div>
	</div>
</div> -->
<!-- End Edit Modal -->

<!-- Start Read Modal-->
<!-- <div v-if="readModal" class="modal fade" id="readModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Read Category</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-bordered" width="100%" cellspacing="0">
					<tr>
						<td width="20%"><b>Name</b></td>
						<td width="80%">{{chooseCategory.category_name}}</td>
					</tr>
					<tr>
						<td width="20%"><b>Description</b></td>
						<td width="80%">{{chooseCategory.category_description}}</td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary"  data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div> -->
<!-- End Read Modal -->
<?php include 'modal.php';?>
</div>
<!-- /.container-fluid -->

<script src="<?php echo base_url(); ?>assets/js/app/appCategoryJS.js"></script>


