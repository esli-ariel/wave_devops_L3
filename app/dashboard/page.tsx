"use client"

import { useState } from "react"
import { Button } from "@/components/ui/button"
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card"
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar"
import { Badge } from "@/components/ui/badge"
import {
  Send,
  Download,
  CreditCard,
  User,
  Settings,
  Bell,
  Eye,
  EyeOff,
  ArrowUpRight,
  ArrowDownLeft,
  QrCode,
  Users,
  TrendingUp,
} from "lucide-react"
import Link from "next/link"

export default function Dashboard() {
  const [showBalance, setShowBalance] = useState(true)

  const recentTransactions = [
    {
      id: 1,
      type: "sent",
      recipient: "Kouame Jean",
      amount: 25000,
      date: "Aujourd'hui 14:30",
      status: "completed",
    },
    {
      id: 2,
      type: "received",
      sender: "Aya Marie",
      amount: 15000,
      date: "Hier 09:15",
      status: "completed",
    },
    {
      id: 3,
      type: "sent",
      recipient: "Koffi Paul",
      amount: 50000,
      date: "2 jours",
      status: "pending",
    },
  ]

  const quickActions = [
    { icon: Send, label: "Envoyer", href: "/transfer", color: "bg-blue-500" },
    { icon: Download, label: "Recevoir", href: "/receive", color: "bg-green-500" },
    { icon: CreditCard, label: "Paiement", href: "/payment", color: "bg-purple-500" },
    { icon: QrCode, label: "Services Agent", href: "/agent-services", color: "bg-orange-500" },
  ]

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Header */}
      <header className="bg-white shadow-sm border-b">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between items-center h-16">
            <div className="flex items-center space-x-4">
              <div className="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                <span className="text-white font-bold text-sm">W</span>
              </div>
              <h1 className="text-xl font-semibold text-gray-900">Wave CI</h1>
            </div>
            <div className="flex items-center space-x-4">
              <Button variant="ghost" size="icon">
                <Bell className="h-5 w-5" />
              </Button>
              <Avatar>
                <AvatarImage src="/placeholder-user.jpg" />
                <AvatarFallback>KJ</AvatarFallback>
              </Avatar>
            </div>
          </div>
        </div>
      </header>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
          {/* Main Content */}
          <div className="lg:col-span-2 space-y-8">
            {/* Balance Card */}
            <Card className="bg-gradient-to-r from-blue-600 to-purple-600 text-white">
              <CardHeader>
                <div className="flex justify-between items-start">
                  <div>
                    <CardDescription className="text-blue-100">Solde principal</CardDescription>
                    <CardTitle className="text-3xl font-bold mt-2">
                      {showBalance ? "1,250,000 FCFA" : "••••••••"}
                    </CardTitle>
                  </div>
                  <Button
                    variant="ghost"
                    size="icon"
                    onClick={() => setShowBalance(!showBalance)}
                    className="text-white hover:bg-white/20"
                  >
                    {showBalance ? <EyeOff className="h-5 w-5" /> : <Eye className="h-5 w-5" />}
                  </Button>
                </div>
              </CardHeader>
              <CardContent>
                <div className="flex justify-between items-center">
                  <div>
                    <p className="text-blue-100 text-sm">Numéro de compte</p>
                    <p className="font-semibold">+225 07 XX XX XX XX</p>
                  </div>
                  <Badge variant="secondary" className="bg-white/20 text-white">
                    Vérifié
                  </Badge>
                </div>
              </CardContent>
            </Card>

            {/* Quick Actions */}
            <Card>
              <CardHeader>
                <CardTitle>Actions rapides</CardTitle>
              </CardHeader>
              <CardContent>
                <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                  {quickActions.map((action, index) => (
                    <Link key={index} href={action.href}>
                      <div className="flex flex-col items-center p-4 rounded-lg border hover:bg-gray-50 transition-colors cursor-pointer">
                        <div className={`w-12 h-12 ${action.color} rounded-full flex items-center justify-center mb-3`}>
                          <action.icon className="h-6 w-6 text-white" />
                        </div>
                        <span className="text-sm font-medium text-gray-700">{action.label}</span>
                      </div>
                    </Link>
                  ))}
                </div>
              </CardContent>
            </Card>

            {/* Recent Transactions */}
            <Card>
              <CardHeader className="flex flex-row items-center justify-between">
                <CardTitle>Transactions récentes</CardTitle>
                <Button variant="outline" size="sm" asChild>
                  <Link href="/history">Voir tout</Link>
                </Button>
              </CardHeader>
              <CardContent>
                <div className="space-y-4">
                  {recentTransactions.map((transaction) => (
                    <div key={transaction.id} className="flex items-center justify-between p-4 border rounded-lg">
                      <div className="flex items-center space-x-4">
                        <div
                          className={`w-10 h-10 rounded-full flex items-center justify-center ${
                            transaction.type === "sent" ? "bg-red-100" : "bg-green-100"
                          }`}
                        >
                          {transaction.type === "sent" ? (
                            <ArrowUpRight className="h-5 w-5 text-red-600" />
                          ) : (
                            <ArrowDownLeft className="h-5 w-5 text-green-600" />
                          )}
                        </div>
                        <div>
                          <p className="font-medium">
                            {transaction.type === "sent" ? transaction.recipient : transaction.sender}
                          </p>
                          <p className="text-sm text-gray-500">{transaction.date}</p>
                        </div>
                      </div>
                      <div className="text-right">
                        <p
                          className={`font-semibold ${transaction.type === "sent" ? "text-red-600" : "text-green-600"}`}
                        >
                          {transaction.type === "sent" ? "-" : "+"}
                          {transaction.amount.toLocaleString()} FCFA
                        </p>
                        <Badge variant={transaction.status === "completed" ? "default" : "secondary"}>
                          {transaction.status === "completed" ? "Terminé" : "En cours"}
                        </Badge>
                      </div>
                    </div>
                  ))}
                </div>
              </CardContent>
            </Card>
          </div>

          {/* Sidebar */}
          <div className="space-y-6">
            {/* Profile Card */}
            <Card>
              <CardHeader>
                <CardTitle className="flex items-center space-x-2">
                  <User className="h-5 w-5" />
                  <span>Mon Profil</span>
                </CardTitle>
              </CardHeader>
              <CardContent className="space-y-4">
                <div className="flex items-center space-x-3">
                  <Avatar className="h-12 w-12">
                    <AvatarImage src="/placeholder-user.jpg" />
                    <AvatarFallback>KJ</AvatarFallback>
                  </Avatar>
                  <div>
                    <p className="font-semibold">Kouame Jean</p>
                    <p className="text-sm text-gray-500">+225 07 XX XX XX XX</p>
                  </div>
                </div>
                <Button variant="outline" className="w-full" asChild>
                  <Link href="/profile">
                    <Settings className="h-4 w-4 mr-2" />
                    Gérer le profil
                  </Link>
                </Button>
              </CardContent>
            </Card>

            {/* Stats Card */}
            <Card>
              <CardHeader>
                <CardTitle className="flex items-center space-x-2">
                  <TrendingUp className="h-5 w-5" />
                  <span>Statistiques</span>
                </CardTitle>
              </CardHeader>
              <CardContent className="space-y-4">
                <div className="flex justify-between items-center">
                  <span className="text-sm text-gray-600">Ce mois</span>
                  <span className="font-semibold">15 transactions</span>
                </div>
                <div className="flex justify-between items-center">
                  <span className="text-sm text-gray-600">Total envoyé</span>
                  <span className="font-semibold">450,000 FCFA</span>
                </div>
                <div className="flex justify-between items-center">
                  <span className="text-sm text-gray-600">Total reçu</span>
                  <span className="font-semibold">320,000 FCFA</span>
                </div>
              </CardContent>
            </Card>

            {/* Quick Contacts */}
            <Card>
              <CardHeader>
                <CardTitle className="flex items-center space-x-2">
                  <Users className="h-5 w-5" />
                  <span>Contacts fréquents</span>
                </CardTitle>
              </CardHeader>
              <CardContent>
                <div className="space-y-3">
                  {["Aya Marie", "Koffi Paul", "Fatou Diallo"].map((contact, index) => (
                    <div key={index} className="flex items-center justify-between">
                      <div className="flex items-center space-x-3">
                        <Avatar className="h-8 w-8">
                          <AvatarFallback>
                            {contact
                              .split(" ")
                              .map((n) => n[0])
                              .join("")}
                          </AvatarFallback>
                        </Avatar>
                        <span className="text-sm font-medium">{contact}</span>
                      </div>
                      <Button size="sm" variant="ghost">
                        <Send className="h-4 w-4" />
                      </Button>
                    </div>
                  ))}
                </div>
              </CardContent>
            </Card>
          </div>
        </div>
      </div>
    </div>
  )
}
