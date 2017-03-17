import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';

@Injectable()
export class UserApi {

    // private baseUrl = 'http://capstone.td9175.com';
    private baseUrl = 'https://capstone17-umbhealth-i2.firebaseio.com';
    
    // userdata: any; 

    constructor(private http: Http) { }
    /*
    getUserData(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/rest/hsa/id/19.json`)
                .subscribe(res => resolve(res.json()));
        });
    */
        

    getUserData(){
    return new Promise(resolve => {
        this.http.get(`${this.baseUrl}/0`)
            .subscribe(res => resolve(res.json()));
    });
    
    }
} //end export class