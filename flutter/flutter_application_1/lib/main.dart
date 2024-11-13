import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;

void main() {
  runApp(const MyWidget());
}

class MyWidget extends StatelessWidget {
  const MyWidget({super.key});

  @override
  Widget build(BuildContext context) {
    return const MaterialApp(
      debugShowCheckedModeBanner: false,
      home: HomePage(),
    );
  }
}

class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  _HomePageState createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  final List<dynamic> _dataList = [];
  String serverMsg = '';
  final TextEditingController _searchController = TextEditingController();

  void fetchData() async {
    String queryParam = _searchController.text;
    if (queryParam.isEmpty) {
      setState(() {
        serverMsg = 'Digite um CPF ou CNPJ para consultar';
      });
      return;
    }

    final isCnpj = queryParam.length == 14;
    final url = isCnpj
        ? 'http://localhost/api-flutter/controle.php?getEmpresa&cnpj=$queryParam'
        : 'http://localhost/api-flutter/controle.php?getPessoa&cpf=$queryParam';

    try {
      http.Response response = await http.get(Uri.parse(url));

      if (response.statusCode == 200) {
        _dataList.clear();
        var decodedResponse = jsonDecode(response.body);

        if (decodedResponse is List) {
          for (var jsonItem in decodedResponse) {
            _dataList.add(Item.fromJson(jsonItem, isCnpj));
          }
        } else {
          _dataList.add(Item.fromJson(decodedResponse, isCnpj));
        }

        setState(() {});
      } else {
        serverMsg = 'Erro ao consultar dados';
        setState(() {});
      }
    } catch (error) {
      serverMsg = 'Erro: $error';
      setState(() {});
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFF222222),
      appBar: AppBar(
        backgroundColor: const Color(0xFF333333),
      ),
      body: SafeArea(
        child: Center(
          child: Container(
            padding: const EdgeInsets.all(16),
            decoration: BoxDecoration(
              color: const Color(0xFF222222),
              borderRadius: BorderRadius.circular(16),
              border: Border.all(color: const Color(0xFF9732FF), width: 4),
              boxShadow: [
                BoxShadow(
                  color: const Color(0xFF9732FF).withOpacity(0.6),
                  spreadRadius: 3,
                  blurRadius: 10,
                  offset: const Offset(0, 0), 
                ),
              ],
            ),
            child: Column(
              mainAxisAlignment: MainAxisAlignment.start,
              children: [
                const Padding(
                  padding: EdgeInsets.only(top: 30.0),
                  child: Text(
                    'Consulta de Dados',
                    style: TextStyle(
                      fontSize: 24,
                      fontWeight: FontWeight.bold,
                      color: Color(0xFF9732FF),
                    ),
                  ),
                ),
                const SizedBox(height: 50),
                Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 16),
                  child: Column(
                    children: [
                      TextField(
                        controller: _searchController,
                        style: const TextStyle(color: Colors.white),
                        decoration: InputDecoration(
                          labelText: 'Informe o CPF ou CNPJ',
                          labelStyle: const TextStyle(color: Colors.white, fontSize: 14),
                          hintStyle: const TextStyle(color: Colors.white),
                          focusedBorder: const OutlineInputBorder(
                            borderSide: BorderSide(color: Color(0xFF9732FF), width: 2),
                          ),
                          border: OutlineInputBorder(
                            borderRadius: BorderRadius.circular(10),
                            borderSide: const BorderSide(color: Colors.white),
                          ),
                        ),
                        keyboardType: TextInputType.text,
                      ),
                      const SizedBox(height: 16),
                      ElevatedButton(
                        onPressed: fetchData,
                        style: ElevatedButton.styleFrom(
                          backgroundColor: const Color(0xFF9732FF),
                          padding: const EdgeInsets.symmetric(vertical: 15, horizontal: 40),
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(8),
                          ),
                          shadowColor: const Color(0xFF9732FF),
                          elevation: 8,
                        ),
                        child: const Text(
                          'Consultar',
                          style: TextStyle(
                            fontSize: 18,
                            fontWeight: FontWeight.w500,
                            color: Colors.white,
                          ),
                        ),
                      ),
                    ],
                  ),
                ),
                Expanded(
                  child: _dataList.isEmpty
                      ? Center(child: Text(serverMsg, style: const TextStyle(color: Colors.white)))
                      : ListView.builder(
                          itemCount: _dataList.length,
                          itemBuilder: (context, index) {
                            final item = _dataList[index];
                            return Card(
                              margin: const EdgeInsets.all(8),
                              color: const Color(0xFF333333),
                              elevation: 8,
                              shadowColor: const Color(0xFF9732FF),
                              shape: RoundedRectangleBorder(
                                borderRadius: BorderRadius.circular(15),
                              ),
                              child: ListTile(
                                title: Text(item.name, style: const TextStyle(color: Colors.white)),
                                subtitle: Text(item.email, style: const TextStyle(color: Colors.white)),
                                trailing: Row(
                                  mainAxisSize: MainAxisSize.min,
                                  children: [
                                    IconButton(
                                      icon: const Icon(Icons.edit, color: Colors.green),
                                      onPressed: () {},
                                    ),
                                    IconButton(
                                      icon: const Icon(Icons.delete, color: Colors.red),
                                      onPressed: () {},
                                    ),
                                  ],
                                ),
                              ),
                            );
                          },
                        ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}

class Item {
  final String name;
  final String email;

  Item({required this.name, required this.email});

  factory Item.fromJson(Map<String, dynamic> json, bool isCnpj) {
    return Item(
      name: json[isCnpj ? 'nome_empresa' : 'nome_pessoa'] ?? 'N/A',
      email: json[isCnpj ? 'email_empresa' : 'email_pessoa'] ?? 'N/A',
    );
  }
}
