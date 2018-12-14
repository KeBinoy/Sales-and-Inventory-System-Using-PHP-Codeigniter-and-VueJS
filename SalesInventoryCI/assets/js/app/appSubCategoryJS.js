Vue.component('modal',{ //modal
    template:`
    <transition
    enter-active-class="animated rollIn"
    leave-active-class="animated rollOut">
    <div class="modal is-active" >
    <div class="modal-card border border border-secondary">
    <div class="modal-card-head text-center bg-dark">
    <div class="modal-card-title text-white">
    <slot name="head"></slot>
    </div>
    <button class="delete" @click="$emit('close')"></button>
    </div>
    <div class="modal-card-body">
    <slot name="body"></slot>
    </div>
    <div class="modal-card-foot" >
    <slot name="foot"></slot>
    </div>
    </div>
    </div>
    </transition>
    `
})

var v = new Vue({
	el: '#appSubCategory',
	data: {
		message: 'Hello sub!',
		url:'http://localhost:8080/salesinventoryci/',
		subCategories:[],
        categories:[],
		emptyResult:false,
		newSubCategory:{
			category_id:'',
            sub_category_name:'',
			sub_category_description:''
		},
		search: {text: ''},
		formValidate:[],
        chooseSubCategory:{},
        sortData:{},
        successMSG:'',
        addModal: false,
        editModal: false,
        readModal: false,
		//Pagination
		currentPage: 0,
		rowCountPage:10,
		totalSubCategories:0,
		pageRange:2
	},
	created(){
		this.showAll(); 
        this.showAllCategory(); 
	},
	methods:
	{
		showAll()
		{ 
			axios.get(this.url+"SubCategory/getAllSubCategoryJS").then(function(response){
				if(response.data.subCategories == null){
					v.noResult()
				}else{
					console.log(response.data.subCategories);
					v.getData(response.data.subCategories);
				}
			})
		},
        showAllCategory()
        { 
            axios.get(this.url+"Category/getAllCategoryJS").then(function(response){
                if(response.data.categories == null){
                    v.noResult()
                }else{
                    console.log(response.data.categories);
                    v.categories = response.data.categories;
                }
            })
        },
        searchSubCategory(){
            var formData = v.formData(v.search);
            axios.post(this.url+"SubCategory/searchSubCategoryJS", formData).then(function(response){
                console.log(response.data.subCategories);
                if(response.data.subCategories == null){
                  v.noResult()
              }else{
                  v.getData(response.data.subCategories);

              }  
          })
        },  
        getData(d)
        {
            v.emptyResult = false; // become false if has a record
            v.totalSubCategories = d.length //get total of category
            v.subCategories = d.slice(v.currentPage * v.rowCountPage, (v.currentPage * v.rowCountPage) + v.rowCountPage); //slice the result for pagination
             // if the record is empty, go back a page
             if(v.subCategories.length == 0 && v.currentPage > 0){ 
             	v.pageUpdate(v.currentPage - 1)
             	v.clearAll();  
             }
         },
         addSubCategory(){   
         	var formData = v.formData(v.newSubCategory);
         	axios.post(this.url+"SubCategory/createSubCategoryJS", formData).then(function(response){
         		if(response.data.error){
         			v.formValidate = response.data.msg;
         		}else{
         			v.successMSG = response.data.msg;
         			v.clearAll();
         			v.clearMSG();
         		}
         	})
         },
         editSubCategory(){
            v.editModal = true;
            v.readModal = false;
        },
        updateSubCategory(){
            var formData = v.formData(v.chooseSubCategory); axios.post(this.url+"SubCategory/updateSubCategoryJS", formData).then(function(response){
                if(response.data.error){
                    v.formValidate = response.data.msg;
                }else{
                  v.successMSG = response.data.success;
                  v.clearAll();
                  v.clearMSG();

              }
          })
        },
        selectSubCategory(subcategory){
            v.chooseSubCategory = subcategory; 
        },
        formData(obj){
              var formData = new FormData();
              for ( var key in obj ) {
                 formData.append(key, obj[key]);
             } 
             return formData;
        },
        clearAll(){
            v.newSubCategory = {
                category_id:'',
                sub_category_name:'',
                sub_category_description:''
            };
            v.formValidate = false;
            v.addModal = false;
            v.editModal = false;
            v.readModal = false;
            v.refresh()
        },
        noResult(){
            v.emptyResult = true;  // become true if the record is empty, print 'No Record Found'
            v.subCategories = null 
            v.totalSubCategories = 0 //remove current page if is empty
        },
        clearMSG(){
          setTimeout(function(){
             v.successMSG=''
			 },3000); // disappearing message success in 2 sec
        },
        pageUpdate(pageNumber){
              v.currentPage = pageNumber; //receive currentPage number came from pagination template
              v.refresh();
        },
        refresh(){
            v.search.text ? v.searchSubCategory() : v.showAll(); //for preventing
            // v.sortData.sort ? v.sort(v.sortData.sort) : v.showAll();
            // console.log(v.sortData);
        }
    },
})