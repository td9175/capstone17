import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';

@Injectable()
export class UserApi {

    private baseUrl = 'http://capstone.td9175.com';
    private userid = 19;
    // userid 19 is the test 
    
    public drugToSearch = 'advil';
    public data: any;

    constructor(private http: Http) { }
    // much much better way to do this.
    getUserData(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/rest/hsa/id/${this.userid}.json`)
                .subscribe(res => resolve(res.json()));
        });
    }

    getProductData(){
        /*return new Promise(resolve =>{
            this.http.get(`${this.baseUrl}/ci/index.php/Drugs/search_for_drug/${this.drugToSearch}`)
                .subscribe(res => resolve(res.json()));
        });*/

        if (this.data) {
            // already loaded data
            return Promise.resolve(this.data);
        }

        // don't have the data yet
        return new Promise(resolve => {
            // We're using Angular HTTP provider to request the data,
            // then on the response, it'll map the JSON data to a parsed JS object.
            // Next, we process the data and resolve the promise with the new data.
            this.http.get(`${this.baseUrl}/ci/index.php/Drugs/search_for_drug/advil`)
            .map(res => res.json())
            .subscribe(data => {
                // we've got back the raw data, now generate the core schedule data
                // and save the data for later reference
                this.data = data;
                resolve(this.data);
            });
        });
    }

    // this is for testing purposes, working json file stored on firebase.
    // private baseUrl = 'https://capstone17-umbhealth-i2.firebaseio.com';
    /*
    getUserData(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/0`)
                .subscribe(res => resolve(res.json()));
        });
    }
*/
} //end export class