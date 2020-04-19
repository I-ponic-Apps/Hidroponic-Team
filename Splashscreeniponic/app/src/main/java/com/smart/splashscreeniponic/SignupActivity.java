package com.smart.splashscreeniponic;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;

public class SignupActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup);
    }

    @Override
    public void onBackPressed() {
        Intent dsp = new Intent(SignupActivity.this, FrontActivity.class);
        startActivity(dsp);
        finish();
    }
}
