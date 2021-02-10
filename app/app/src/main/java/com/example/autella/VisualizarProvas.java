package com.example.autella;

import android.os.Bundle;
import android.widget.ListView;
import android.content.Intent;


import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;

public class VisualizarProvas extends AppCompatActivity {
    private ListView listaProvas;
    private ArrayList<String> nomes;
    private ItemListaProvas adapter;

    private RequestQueue mQueue;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_visualizar_provas);
        listaProvas = (ListView) findViewById(R.id.listaProvas);

        Intent intencao = getIntent();
        carregaEventosLista();
    }

    private void carregaEventosLista(){
        nomes = new ArrayList<>();

//        nomes.add("Provawrd 1");
//        nomes.add("provffaw 2");
//        nomes.add("proaawfvsdas 3");
//        nomes.add("awoindawndáw prvoa 4");

        mQueue = Volley.newRequestQueue(this);
//        String urlDoRequest = "http://autella.com/api/require.php?metodo=1";
        String urlDoRequest = "http://10.0.2.2/autella.com/api/require.php?metodo=1";
        System.out.println("BugPoint 1");
        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, urlDoRequest, null,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            JSONArray jsonArray = response.getJSONArray("provas");
                            for(int i = 0; i < jsonArray.length(); i++){
                                JSONObject prova = jsonArray.getJSONObject(i);
                                String nomeDaProva = prova.getString("name");
                                nomes.add(nomeDaProva);
                            }
                            adapter = new ItemListaProvas(getApplicationContext(), nomes);
                            listaProvas.setAdapter(adapter);

                        } catch (JSONException e) {
                            e.printStackTrace();
                            System.out.println("BugPoint 3");
                        }
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                error.printStackTrace();
            }
        });
        mQueue.add(request);
    }
}
