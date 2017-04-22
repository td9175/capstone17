import { Injectable } from '@angular/core';
import { Http, Response, Headers, RequestOptions, URLSearchParams } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map';

@Injectable()
export class UserApi {

    private baseUrl = 'https://capstone.td9175.com';
    // hard coded email for right now.
    private userid = 'umbcapstone17@gmail.com';
    baseid = encodeURIComponent(this.userid);
    
    public drugToSearch: any;
    public drugToGetDetails: any;
    public fullData: any;
    public user: any;

    constructor(private http: Http) { }

    getUserHSAData(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/HealthAccount/hsa/email/${this.baseid}`)
                .subscribe(res => resolve(res.json()));
        });
    }

    getUserFSAData(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/HealthAccount/fsa/email/${this.baseid}`)
                .subscribe(res => resolve(res.json()));
        });
    }

    getUserInfoData(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/UserAccount/user/${this.baseid}`)
                .subscribe(res => resolve(res.json()));
        });
    }

    // GET request: /UserAccount/user .. if it's logged in, brings up user data: name
    // https://capstone.td9175.com/ci/index.php/HealthAccount/hsa/email/umbcapstone17%40gmail.com
    
    getProductData(){
        return this.http.get(`${this.baseUrl}/ci/index.php/Drugs/search_for_drug/${this.drugToSearch}`).map(res => res.json());
    }

    getProductPrices(){
        return this.http.get(`${this.baseUrl}/ci/index.php/Drugs/price_comparison/${this.drugToGetDetails}`).map(res => res.json());
    }

    
    
    /*Getting Account Details*/
    getHsaTransaction(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/AccountTransaction/hsa_transaction/email/${this.baseid}`)
                .subscribe(res => resolve(res.json()));
        });
    }

    getFsaTransaction(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/AccountTransaction/fsa_transaction/email/${this.baseid}`)
                .subscribe(res => resolve(res.json()));
        });
    }

    getHsaBalance(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/AccountTransaction/hsa_balance/email/${this.baseid}`)
                .subscribe(res => resolve(res.json()));
        });
    }

    getFsaBalance(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/AccountTransaction/fsa_balance/email/${this.baseid}`)
                .subscribe(res => resolve(res.json()));
        });
    }
    
    
    // Firebase test data:
    // private baseUrl = 'https://capstone17-umbhealth-i2.firebaseio.com';
}
 
export class User {
  email: string;
  ci_session: string;
 
  constructor() {
  }
}
 
@Injectable()
export class AuthService {
  currentUser: User;
  loginReturn: any;
  registerReturn: any;

  constructor(private http: Http) { }

  public postLogin(email, password){ 
      console.log("postLoginBegin");
        let body = new URLSearchParams();
            body.set('email', email);
            body.set('password', password);
        let headers = new Headers({ 'Content-Type': 'application/form-data' });
        let options = new RequestOptions({ headers: headers });

        return this.http.post('https://capstone.td9175.com/ci/index.php/UserAccount/login/', body)
                    .map((res:Response) => res.json())
                    .catch((error:any) => Observable.throw(error.json().error || 'Server error'));
  }

  public postRegister(email, password, first_name, last_name) { 
        let body = new URLSearchParams();
            body.set('email', email);
            body.set('password', password);
            body.set('first_name', first_name);
            body.set('last_name', last_name);
        let headers = new Headers({ 'Content-Type': 'application/form-data' });
        let options = new RequestOptions({ headers: headers });

        return this.http.post('https://capstone.td9175.com/ci/index.php/UserAccount/register/', body)
                    .map((res:Response) => res.json())
                    .catch((error:any) => Observable.throw(error.json().error || 'Server error'));
  }
 
  public appLogin(email, password) {
    this.currentUser.email = "";
    this.currentUser.ci_session = "";
    console.log(email);
    console.log(password);
    if (email === null || password === null) {
      return this.currentUser;
    } else {
        console.log("appLoginBegin");
      this.postLogin(email, password).subscribe(
          data => this.currentUser.ci_session = data.ci_session,
          err => console.log('error: ', err),
          () => console.log('currentUser.ci_session: ', this.currentUser.ci_session)
        );
        return this.currentUser;
    }
  }
 
  public appRegisterUser(email, password, first_name, last_name) {
    if (email === null || password === null || first_name === null || last_name === null) {
      return Observable.throw("Please fill out the form.");
    } else {
      return Observable.create(observer => {
       this.postRegister(email, password, first_name, last_name).subscribe(
          data => this.registerReturn = data.success,
          err => console.log('error: ', err),
          () => console.log('registerReturn: ', this.registerReturn)
        );
        observer.complete();
      });
    }
  }
 
  public appGetUser() : User {
    console.log("currentUser is: ", this.currentUser);
    return this.currentUser;
  }
 
  public appLogout() {
    return new Promise(resolve => {
        this.currentUser = null;
        this.http.get(`https://capstone.td9175.com/ci/index.php/UserAccount/logout`)
            .subscribe(res => resolve(res.json()));
    });
  }
}