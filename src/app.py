from flask import Flask, render_template

app = Flask(__name__)

@app.route('/login')
def show_login_panel():
    return render_template('login_view.html')

@app.route('/register')
def show_register_panel():
    return render_template('register_view.html')

if __name__ == "__main__":
    app.run(debug=True)