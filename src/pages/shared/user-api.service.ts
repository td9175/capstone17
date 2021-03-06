import { Injectable } from '@angular/core';
import { Http, Response, Headers, RequestOptions, URLSearchParams } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map';

@Injectable()
export class UserGlobals {
    public globalEmail: string;
    public globalSession: string;
    public didRegister: boolean;
    public parsedPrices: any;
  
  constructor() {
    this.globalEmail = null;
    this.globalSession = null;
    this.didRegister = false;
    this.parsedPrices = null;
  }

  sleep (time) {
      return new Promise((resolve) => setTimeout(resolve, time));
  }

  setGlobalEmail(email) {
    this.globalEmail = email;
  }

  setGlobalSession(session) {
      this.globalSession = session;
  }

  getGlobalEmail() {
    return this.globalEmail;
  }

  getGlobalSession() {
      return this.globalSession;
  }

  isLoggedIn() {
      if(this.getGlobalEmail() == null || this.getGlobalSession() == null) {
          console.log("isloggedin returning false");
          return false;
      }
      else {
          console.log("isloggedin returning true");
          return true;
      }
  }

  getDidRegister() {
      return this.didRegister;
  }

  setDidRegister(reg) {
      this.didRegister = reg;
  }

  setParsedPrices(parsedPrices) {
      this.parsedPrices = parsedPrices;
  }

  getParsedPrices() {
      return this.parsedPrices;
  }

}

@Injectable()
export class UserApi {

    private baseUrl = 'https://capstone.td9175.com';
    // hard coded email for right now.
    //private userid = 'umbcapstone17@gmail.com';
    //baseid = encodeURIComponent(this.userid);
    
    public drugToSearch: any;
    public drugToGetDetails: any;
    public fullData: any;
    public user: any;
    public receiptImageToGet: any;

    constructor(private http: Http, private userGlobals: UserGlobals) { }

    getUserHSAData(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/HealthAccount/hsa/email/${encodeURIComponent(this.userGlobals.getGlobalEmail())}/token/${this.userGlobals.getGlobalSession()}`)
                .subscribe(res => resolve(res.json()));
        });
    }

    getUserFSAData(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/HealthAccount/fsa/email/${encodeURIComponent(this.userGlobals.getGlobalEmail())}/token/${this.userGlobals.getGlobalSession()}`)
                .subscribe(res => resolve(res.json()));
        });
    }

    getUserInfoData(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/UserAccount/user/email/${encodeURIComponent(this.userGlobals.getGlobalEmail())}/token/${this.userGlobals.getGlobalSession()}`)
                .subscribe(res => resolve(res.json()));
        });
    }

    // GET request: /UserAccount/user .. if it's logged in, brings up user data: name
    // https://capstone.td9175.com/ci/index.php/HealthAccount/hsa/email/umbcapstone17%40gmail.com
    
    getProductData(){
        return this.http.get(`${this.baseUrl}/ci/index.php/Drugs/search_for_drug/searchQuery/${this.drugToSearch}/token/${this.userGlobals.getGlobalSession()}`).map(res => res.json());
    }

    getProductPrices(){
        return this.http.get(`${this.baseUrl}/ci/index.php/Drugs/price_comparison/name/${this.drugToGetDetails}/token/${this.userGlobals.getGlobalSession()}`).map(res => res.json());
    }
    
    /*Getting Account Details*/
    getHsaTransaction(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/AccountTransaction/hsa_transaction/email/${encodeURIComponent(this.userGlobals.getGlobalEmail())}/token/${this.userGlobals.getGlobalSession()}`)
                .subscribe(res => resolve(res.json()));
        });
    }

    getFsaTransaction(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/AccountTransaction/fsa_transaction/email/${encodeURIComponent(this.userGlobals.getGlobalEmail())}/token/${this.userGlobals.getGlobalSession()}`)
                .subscribe(res => resolve(res.json()));
        });
    }

    getHsaBalance(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/AccountTransaction/hsa_balance/email/${encodeURIComponent(this.userGlobals.getGlobalEmail())}/token/${this.userGlobals.getGlobalSession()}`)
                .subscribe(res => resolve(res.json()));
        });
    }

    getFsaBalance(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/AccountTransaction/fsa_balance/email/${encodeURIComponent(this.userGlobals.getGlobalEmail())}/token/${this.userGlobals.getGlobalSession()}`)
                .subscribe(res => resolve(res.json()));
        });
    }

    getReceipts(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/Receipt/user_receipts/email/${encodeURIComponent(this.userGlobals.getGlobalEmail())}/token/${this.userGlobals.getGlobalSession()}`)
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
  loginReturn: any;
  registerReturn: any;

  constructor(private http: Http, private userGlobals: UserGlobals) { }

  public postLogin(email, password){ 
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

        return this.http.post('https://capstone.td9175.com/ci/index.php/UserAccount/registration', body)
                    .map((res:Response) => res.json())
                    .catch((error:any) => Observable.throw(error.json().error || 'Server error'));
  }
 
  public appLogin(email, password) {
    if (email == null || password == null || email == "" || password == "") {
      return null;
    } else if (this.userGlobals.isLoggedIn()) {
        return this.userGlobals.getGlobalSession();
    } else {
      this.postLogin(email, password).subscribe(
          data =>  this.userGlobals.setGlobalSession(data.token),
          err => console.log('error: ', err),
          () => this.userGlobals.setGlobalEmail(email)
        );
        //return this.userGlobals.getGlobalEmail();
    }
  }
 
  public appRegister(email, password, first_name, last_name) {
    if (email == null || password == null || first_name == null || last_name == null || email == "" || password == "" || first_name == "" || last_name == "") {
      //return Observable.throw("Please fill out the form.");
      return null;
    } else {
        this.postRegister(email, password, first_name, last_name).subscribe(
        data => this.userGlobals.setDidRegister(
            function(data) {
                if(data.success == "Much success! Account created. Go login.\n") { 
                    console.log("data.success matched");
                    return true;
                }
                else { console.log("data.success did not match");
                return false; }
            }
        ),
        err => console.log('error: ', err),
        () => console.log('this is a thing')
      );
      return this.userGlobals.getDidRegister();
    }
  }
 
  public appLogout() {
    return new Promise(resolve => {
        this.userGlobals.setGlobalEmail(null);
        this.userGlobals.setGlobalSession(null);
        this.userGlobals.setDidRegister(false);
        this.http.get(`https://capstone.td9175.com/ci/index.php/UserAccount/logout`);
        //reload the app somehow
    });
  }
}