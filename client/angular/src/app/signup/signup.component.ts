import { Component, OnInit } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {Router} from "@angular/router";
import {Signup} from "./signup";
import * as _ from 'lodash';
import {LoginService} from "../login/login.service";
import {Breadcrumb} from "../breadcrumb/breadcrumb";

@Component({
  selector: 'app-signup',
  templateUrl: './signup.component.html',
  styleUrls: ['./signup.component.css']
})
export class SignupComponent implements OnInit {
  breadcrumbLinks: Breadcrumb[] = [
      {link: '', label: 'Home'},
      {link: null, label: 'Signup'}
  ];
  signup: Signup = new Signup();
  signupForm: FormGroup;

  constructor(
      private fb: FormBuilder,
      private router: Router,
      private loginService: LoginService
  ) { }

  ngOnInit() {
      this.signupForm = this.fb.group({
          username: [
              this.signup.username,
              Validators.compose([
                  Validators.required,
                  Validators.minLength(2),
                  Validators.maxLength(255)
              ])
          ],
          password: [
              this.signup.password,
              Validators.compose([
                  Validators.required,
                  Validators.minLength(6),
                  Validators.maxLength(255)
              ])
          ],
          email: [
              this.signup.email,
              Validators.compose([
                  Validators.required,
                  Validators.pattern(/^([0-9a-zA-Z]([-_\\.]*[0-9a-zA-Z]+)*)@([0-9a-zA-Z]([-_\\.]*[0-9a-zA-Z]+)*)[\\.]([a-zA-Z]{2,9})$/),
                  Validators.maxLength(255)
              ])
          ]
      });
  }

  onSubmit(form) {
      console.log(form);
      this.loginService.signUp({SignupForm: form.value})
          .subscribe(
              (user: any) => {
                  this.loginService.currentUser.next(user.user);
                  this.loginService.isLogin.next(true);
                  this.loginService.setAuthKey(user.auth_key);
                  form.setValue(new Signup());
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
