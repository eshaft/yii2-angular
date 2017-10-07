import {Component, OnInit} from '@angular/core';
import {Login} from "./login";
import {User} from "../user/user";
import {LoginService} from "./login.service";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {Router} from "@angular/router";
import * as _ from 'lodash';
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/filter';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  login: Login = new Login;
  isLogin: boolean = false;
  loginForm: FormGroup;

  constructor(
      private fb: FormBuilder,
      private loginService: LoginService,
      private router: Router
  ) { }

  ngOnInit() {
      this.loginService.isLogin.subscribe((res: boolean) => this.isLogin = res);

      this.loginForm = this.fb.group({
          username: [this.login.username, Validators.required],
          password: [this.login.password, Validators.required],
          rememberMe: this.login.rememberMe
      });
  }


    /*backendValidator(name): AsyncValidatorFn {
        return (control: AbstractControl): Observable<any> => {
            return new Observable((obs: any) => {
                this.errors
                    .subscribe(
                        data => {
                            obs.next(null);
                            obs.complete();
                        },
                        error => {
                            console.log(error);
                            obs.next({'backend': true});
                            obs.complete();
                        }
                    );
            });
        }
    }*/


  onSubmit(form) {
      console.log(form);
      this.loginService.login({LoginForm: form.value})
          .subscribe(
              (user: User) => {
                  this.loginService.currentUser.next(user);
                  this.loginService.isLogin.next(true);
                  form.setValue(new Login());
                  this.router.navigate(['/']);
              },
              err => {
                  console.log(err);
                  if(err.status == 422) {
                      let errors = JSON.parse(err.error);
                      _.forEach(errors, (value) => {
                          form.controls[value.field].setErrors({'backend': value.message});
                      });
                  }
              }
          );
  }
}
