import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';

@Injectable()
export class UserApi {

<<<<<<< HEAD
     private baseUrl = 'http://capstone.td9175.com';
  
    
    // userdata: any; 
=======
    private baseUrl = 'http://capstone.td9175.com';
    
    items: any
    //userid: any
>>>>>>> master

    constructor(private http: Http) { }
    
    // much much better way to do this.
    getUserData(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/rest/hsa/id/19.json`)
                .subscribe(res => resolve(res.json()));
        });
    }

    // this is for testing purposes, working json file stored on firebase.
    // private baseUrl = 'https://capstone17-umbhealth-i2.firebaseio.com';
    /*
    getUserData(){
<<<<<<< HEAD
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/0`)
                .subscribe(res => resolve(res.json()));
        });
    }
*/
=======
    return new Promise(resolve => {
        this.http.get(`${this.baseUrl}/0.json`)
            .subscribe(res => resolve(res.json()));
        });
    }
    */
>>>>>>> master
} //end export class