class Message {

    successMessage(message)
    {
        Vue.toasted.show(message, { 
            theme: "toasted-primary", 
            type : 'success',
            position:'top-right' ,
            icon :'check',
            iconPack:'fontawesome' ,
            duration : 5000
        }); 
    }

    errorMessage(message)
    {
        Vue.toasted.show(message, { 
            theme: "toasted-primary", 
            type : 'error',
            position:'top-right' ,
            icon :'warning',
            iconPack:'fontawesome' ,
            duration : 5000
        }); 
    }

}

export default Message;