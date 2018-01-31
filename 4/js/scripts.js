/*-------------------------------------------------*/
/*   VARIABLE                                      */
/*-------------------------------------------------*/
const inputFullName = document.getElementById('fullname');
const inputUserName = document.getElementById('username');
const inputEmail = document.getElementById('email');
const inputPassword = document.getElementById('password');
var inputeditFullName = document.getElementById('editfullname');
var inputeditUserName = document.getElementById('editusername');
var inputeditEmail = document.getElementById('editemail');
var inputeditPassword = document.getElementById('editpassword');
const searchForm = document.getElementById('searchForm');
var searchInput = document.getElementById('searchInput');
const addUserModal = document.getElementById('addUserModal');
const editUserModal = document.getElementById('editUserModal');
const deleteAllUsers = document.getElementById('deleteAllUsers');
const addNewUser = document.getElementById('addNewUser');
const editUserForm = document.getElementById('editUserForm');
const addUserForm = document.getElementById('addUserForm');
const addUserButtonClose = document.getElementById('addUserButtonClose');
const editUserButtonClose = document.getElementById('editUserButtonClose');
const paginationContainer = document.getElementById('paginationContainer');
var editButton = document.getElementsByClassName("edit-button");
var deleteButton = document.getElementsByClassName("delete-button");
var paginationButton = document.getElementsByClassName("pagination-button");
var showUsersContainer = document.getElementById("showUsers");
var itemsArray = localStorage.getItem('users') ? JSON.parse(localStorage.getItem('users')) : [];
localStorage.setItem('users', JSON.stringify(itemsArray));
var data = JSON.parse(localStorage.getItem('users'));
var useruniqueID = localStorage.getItem('userIDs') ? JSON.parse(localStorage.getItem('userIDs')) : 0;
localStorage.setItem('userIDs', useruniqueID);
/*-------------------------------------------------*/
/*   CREATE USER TABLE                             */
/*-------------------------------------------------*/
function createTable() {
	data = JSON.parse(localStorage.getItem('users'));
    userinarray = itemsArray.length;
    var j = 0;
    var userPerPage = 10;
    var pager = 1;
    showUsersContainer.innerHTML = "";
    while (j < userinarray) {
        if (j == userPerPage) {
            pager++;
            userPerPage += 10
        }
        let liUser = document.createElement("li");
        liUser.setAttribute("data-id", data[j].userID);
        liUser.setAttribute("data-page", pager);
        let ul = document.createElement("ul");
        let lifullname = document.createElement("li");
        lifullname.setAttribute("data-id", "fullname-" + data[j].userID);
        lifullname.innerHTML = data[j].fullname;
        ul.appendChild(lifullname);
        let liusername = document.createElement("li");
        liusername.setAttribute("data-id", "username-" + data[j].userID);
        liusername.innerHTML = data[j].username;
        ul.appendChild(liusername);
        let liemail = document.createElement("li");
        liemail.setAttribute("data-id", "email-" + data[j].userID);
        liemail.innerHTML = data[j].email;
        ul.appendChild(liemail);
        let lipassword = document.createElement("li");
        lipassword.setAttribute("data-id", "password-" + data[j].userID);
        lipassword.innerHTML = data[j].password;
        ul.appendChild(lipassword);
        let liedit = document.createElement("li");
        liedit.innerHTML = '<button id="' + data[j].userID + '" class="edit-button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</button>';
        ul.appendChild(liedit);
        let lidelete = document.createElement("li");
        lidelete.innerHTML = '<button id="' + data[j].userID + '" class="delete-button"><i class="fa fa-times" aria-hidden="true"></i>Delete</button>';
        ul.appendChild(lidelete);
        liUser.appendChild(ul);
        showUsersContainer.appendChild(liUser);
        j++;

    }
}
createTable.call();
/*-------------------------------------------------*/
/*   ADD USER FUNCTION                             */
/*-------------------------------------------------*/
function addUserFuntion(userID, fullname, username, email, password) {
        this.userID = userID;
        this.fullname = fullname;
        this.username = username;
        this.email = email;
        this.password = password;
    }
/*-------------------------------------------------*/
/*   SEARCH FUNCTION                               */
/*-------------------------------------------------*/
function searchFunction() {
        let filter = searchInput.value.toUpperCase();
        ul = document.getElementById("showUsers");
        li = ul.children;
        for (i = 0; i < li.length; i++) {
            let ab = li[i].getElementsByTagName("ul")[0];
            let a = ab.firstChild.innerHTML.toUpperCase();
            if (a.indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
        if (searchInput.value == "") {
            paginationFunction.call();
        }
    }
/*-------------------------------------------------*/
/*   ADD USER FORM                                 */
/*-------------------------------------------------*/
addUserForm.addEventListener('submit', function(e) {
    e.preventDefault();
    let AddUser = new addUserFuntion(useruniqueID, inputFullName.value, inputUserName.value, inputEmail.value, inputPassword.value);
    itemsArray.push(AddUser);
    localStorage.setItem('users', JSON.stringify(itemsArray));
    useruniqueID++;
    localStorage.setItem('userIDs', useruniqueID);
	createTable.call();
    createPagination.call();
	paginationFunction.call();
	paginationButtonFunction.call();
    inputFullName.value = "";
    inputUserName.value = "";
    inputEmail.value = "";
    inputPassword.value = "";
	editButtonFunction.call();
    deleteButtonFunction.call();
    addUserModal.classList.remove("modal-visible");
});
/*-------------------------------------------------*/
/*   DELETE ALL USERS BUTTON                       */
/*-------------------------------------------------*/
deleteAllUsers.addEventListener('click', function() {
    localStorage.clear();
    showUsersContainer.innerHTML = "";
});
/*-------------------------------------------------*/
/*   OPEN ADD USER MODAL                           */
/*-------------------------------------------------*/
addNewUser.addEventListener('click', function() {
    inputFullName.value = "";
    inputUserName.value = "";
    inputEmail.value = "";
    inputPassword.value = "";
    addUserModal.classList.add("modal-visible");
});
/*-------------------------------------------------*/
/*   CLOSE ADD USER MODAL                          */
/*-------------------------------------------------*/
addUserButtonClose.addEventListener('click', function() {
    addUserModal.classList.remove("modal-visible");
});
/*-------------------------------------------------*/
/*   CLOSE EDIT USER MODAL                         */
/*-------------------------------------------------*/
editUserButtonClose.addEventListener('click', function() {
    editUserModal.classList.remove("modal-visible");
});
/*-------------------------------------------------*/
/*   SEARCH BY ID                                  */
/*-------------------------------------------------*/
function searchbyID(idKey, myArray) {
        for (var i = 0; i < myArray.length; i++) {
            if (myArray[i].userID == idKey) {
                return myArray[i];
            }
        }
    }
/*-------------------------------------------------*/
/*   SEARCH ARRAY BY ID                            */
/*-------------------------------------------------*/
function searchArrayID(idKey, searchedArray) {
        for (var i = 0; i < searchedArray.length; i++) {
            if (searchedArray[i].userID == idKey) {
                return i;
            }
        }
    }
/*-------------------------------------------------*/
/*   EDIT BUTTON                                   */
/*-------------------------------------------------*/
function editButtonFunction() {
for (var e = 0; e < editButton.length; e++) {
    editButton[e].addEventListener('click', function() {
        let editUserID = this.getAttribute("id");
        editUserModal.classList.add("modal-visible");
        let dataedit = searchbyID(editUserID, itemsArray);
        inputeditFullName.value = "";
        inputeditUserName.value = "";
        inputeditEmail.value = "";
        inputeditPassword.value = "";
        inputeditFullName.value = dataedit.fullname;
        inputeditUserName.value = dataedit.username;
        inputeditEmail.value = dataedit.email;
        inputeditPassword.value = dataedit.password;
        editUserModal.setAttribute("data-id", editUserID);
    });
};
};
editButtonFunction.call();
/*-------------------------------------------------*/
/*   EDIT FORM SUBMIT                              */
/*-------------------------------------------------*/
editUserForm.addEventListener('submit', function(e) {
    e.preventDefault();
    let editFormUserID = editUserModal.getAttribute("data-id");
    let editFormArrayID = searchArrayID(editFormUserID, itemsArray);
    itemsArray[editFormArrayID].fullname = inputeditFullName.value;
    itemsArray[editFormArrayID].username = inputeditUserName.value;
    itemsArray[editFormArrayID].email = inputeditEmail.value;
    itemsArray[editFormArrayID].password = inputeditPassword.value;
    localStorage.setItem('users', JSON.stringify(itemsArray));
    let fullname = document.querySelector('[data-id="fullname-' + editFormUserID + '"]');
    let username = document.querySelector('[data-id="username-' + editFormUserID + '"]');
    let email = document.querySelector('[data-id="email-' + editFormUserID + '"]');
    let password = document.querySelector('[data-id="password-' + editFormUserID + '"]');
    fullname.innerHTML = inputeditFullName.value;
    username.innerHTML = inputeditUserName.value;
    email.innerHTML = inputeditEmail.value;
    password.innerHTML = inputeditPassword.value;
    editUserModal.classList.remove("modal-visible");
});
/*-------------------------------------------------*/
/*   DELETE BUTTON                                 */
/*-------------------------------------------------*/
function deleteButtonFunction() {
for (var d = 0; d < deleteButton.length; d++) {
    deleteButton[d].addEventListener('click', function() {
        let deleteUserID = this.getAttribute("id");
        let deleteKey = searchArrayID(deleteUserID, itemsArray);
        itemsArray.splice(deleteKey, 1);
        localStorage.setItem('users', JSON.stringify(itemsArray));
        let editFormUserID = editUserModal.getAttribute("data-id");
        createTable.call();
        createPagination.call();
		paginationFunction.call();
		paginationButtonFunction.call();

    });
};
};
deleteButtonFunction.call();
/*-------------------------------------------------*/
/*   PAGINATION                                    */
/*-------------------------------------------------*/
function createPagination() {
    let paginationItemCounter = showUsersContainer.children;
    let paginationBreak = 10;
    paginationContainer.innerHTML = '';
    let totalPages = Math.ceil(paginationItemCounter.length / paginationBreak);
    for (paginationNumber = 1; paginationNumber <= totalPages; paginationNumber++) {
        let paginationElement = document.createElement("a");
        paginationElement.setAttribute("data-linkpage", paginationNumber);
        paginationElement.setAttribute("class", "pagination-button");
        paginationElement.innerHTML = paginationNumber;
        paginationContainer.appendChild(paginationElement);
    }
}
createPagination.call();
/*-------------------------------------------------*/
/*   PAGINATION FUNCTION                           */
/*-------------------------------------------------*/
function paginationFunction(datalinkpage) {
    let filter = searchInput.value.toUpperCase();
    ul = document.getElementById("showUsers");
    li = ul.children;
	if (typeof datalinkpage === 'undefined') {
    var datalinkpage = 1;
    }
	for (i = 0; i < li.length; i++) {
        let ab = li[i].dataset.page;
        if (ab == datalinkpage) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
paginationFunction.call();
/*-------------------------------------------------*/
/*   PAGINATION BUTTON                              */
/*-------------------------------------------------*/
function paginationButtonFunction() {
for (var g = 0; g < paginationButton.length; g++) {
    paginationButton[g].addEventListener('click', function() {
        var datalinkpage = this.getAttribute("data-linkpage");
		paginationFunction(datalinkpage);
    });
};
};
paginationButtonFunction.call();