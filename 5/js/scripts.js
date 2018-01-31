// AUTHOR : BESIM HADŽIĆ
// PAGE: scripts.js
// DESCRIPTION: JS FILE OF USER ADMINISTRATION
/*-------------------------------------------------*/
/*   OPEN EDIT FORM 
/*-------------------------------------------------*/
function openEditForm() {
var isEditPage = document.getElementById('editpage');
if (isEditPage) {
    const editUserModal = document.getElementById('editUserModal');
	setTimeout(function(){ editUserModal.classList.add("modal-visible"); }, 100);
}
}
/*-------------------------------------------------*/
/*   OPEN ADD FORM 
/*-------------------------------------------------*/
function openAddForm() {
	const addUserModal = document.getElementById('addUserModal');
	addUserModal.classList.add("modal-visible");
} 
/*-------------------------------------------------*/
/*   CLOSE ADD FORM 
/*-------------------------------------------------*/
function closeAddForm() {
	const addUserModal = document.getElementById('addUserModal');
	addUserModal.classList.remove("modal-visible");
} 
/*-------------------------------------------------*/
/*   CALL FUNCTIONS
/*-------------------------------------------------*/
openEditForm.call();

