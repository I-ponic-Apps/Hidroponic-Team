package com.smart.splashscreeniponic;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class FrontActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_front);


        Button sigin = (Button)findViewById(R.id.btn_signin);
        sigin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent dsp = new Intent(FrontActivity.this, LoginActivity.class);
                startActivity(dsp);
                finish();
            }
        });

        Button signup = (Button) findViewById(R.id.btn_signup);
        signup.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent dsp = new Intent(FrontActivity.this, SignupActivity.class);
                startActivity(dsp);
                finish();
            }
        });


        }


    @Override
    public void onBackPressed() {
        Intent dsp = new Intent(FrontActivity.this, MainActivity.class);
        startActivity(dsp);
        finish();
    }
}
