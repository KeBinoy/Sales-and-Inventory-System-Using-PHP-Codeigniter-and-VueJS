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
	el: '#appCategory',
	data: {
		message: 'Hello Vue!',
		url:'http://localhost:8080/salesinventoryci/',
		categories:[],
		emptyResult:false,
		newCategory:{
			category_name:'',
			category_description:''
		},
		search: {text: ''},
		formValidate:[],
        chooseCategory:{},
        sortData:{},
        successMSG:'',
        addModal: false,
        editModal: false,
        readModal: false,
		//Pagination
		currentPage: 0,
		rowCountPage:10,
		totalCategories:0,
		pageRange:2
	},
	created(){
		this.showAll(); 
	},
	methods:
	{
		showAll()
		{ 
			axios.get(this.url+"Category/getAllCategoryJS").then(function(response){
				if(response.data.categories == null){
					v.noResult()
				}else{
					// console.log(response.data.categories);
					v.getData(response.data.categories);
				}
			})
		},
        searchCategory(){
            var formData = v.formData(v.search);
            axios.post(this.url+"Category/searchCategoryJS", formData).then(function(response){
                console.log(response.data.categories);
                if(response.data.categories == null){
                  v.noResult()
              }else{
                  v.getData(response.data.categories);

              }  
          })
        },  
        getData(d)
        {
            v.emptyResult = false; // become false if has a record
            v.totalCategories = d.length //get total of category
            v.categories = d.slice(v.currentPage * v.rowCountPage, (v.currentPage * v.rowCountPage) + v.rowCountPage); //slice the result for pagination
             // if the record is empty, go back a page
             if(v.categories.length == 0 && v.currentPage > 0){ 
             	v.pageUpdate(v.currentPage - 1)
             	v.clearAll();  
             }
         },
         addCategory(){   
         	var formData = v.formData(v.newCategory);
         	axios.post(this.url+"Category/createCategoryJS", formData).then(function(response){
         		if(response.data.error){
         			v.formValidate = response.data.msg;
         		}else{
         			v.successMSG = response.data.msg;
         			v.clearAll();
         			v.clearMSG();
         		}
         	})
         },
         editCategory(){
            v.editModal = true;
            v.readModal = false;
        },
        updateCategory(){
            var formData = v.formData(v.chooseCategory); axios.post(this.url+"Category/updateCategoryJS", formData).then(function(response){
                if(response.data.error){
                    v.formValidate = response.data.msg;
                }else{
                  v.successMSG = response.data.success;
                  v.clearAll();
                  v.clearMSG();

              }
          })
        },
        selectCategory(category){
            v.chooseCategory = category; 
        },
        formData(obj){
              var formData = new FormData();
              for ( var key in obj ) {
                 formData.append(key, obj[key]);
             } 
             return formData;
        },
        clearAll(){
            v.newCategory = {
             category_name:'',
             category_description:''
            };
            v.formValidate = false;
            v.addModal = false;
            v.editModal = false;
            v.readModal = false;
            v.refresh()
        },
        noResult(){
            v.emptyResult = true;  // become true if the record is empty, print 'No Record Found'
            v.categories = null 
            v.totalCategories = 0 //remove current page if is empty
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
            v.search.text ? v.searchCategory() : v.showAll(); //for preventing
            // v.sortData.sort ? v.sort(v.sortData.sort) : v.showAll();
            // console.log(v.sortData);
        }
    },
})