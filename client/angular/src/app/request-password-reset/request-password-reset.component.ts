import { Component, OnInit } from '@angular/core';
import {LoginService} from "../login/login.service";
import {Router} from "@angular/router";
import {Breadcrumb} from "../breadcrumb/breadcrumb";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {Reset} from "./reset";
import * as _ from 'lodash';
import {AlertService} from "../alert.service";

@Component({
  selector: 'app-request-password-reset',
  templateUrl: './request-password-reset.component.html',
  styleUrls: ['./request-password-reset.component.css']
})
export class RequestPasswordResetComponent implements OnInit {
  breadcrumbLinks: Breadcrumb[] = [
      {link: '', label: 'Home'},
      {link: null, label: 'Request password reset'}
  ];
  reset: Reset = new Reset();
  resetForm: FormGroup;

  constructor(
      private fb: FormBuilder,
      private router: Router,
      private loginService: LoginService,
      private alertService: AlertService
  ) { }

  ngOnInit() {
      this.resetForm = this.fb.group({
          email: [
              this.reset.email,
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
        this.loginService.requestPasswordReset({PasswordResetRequestForm: form.value})
            .subscribe(
                (result: any) => {
                    console.log(result);
                    form.setValue(new Reset());
                    if(result.success) {
                        this.alertService.setAlert('success', result.success)
                    }
                    if(result.error) {
                        this.alertService.setAlert('warning', result.error)
                    }
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
