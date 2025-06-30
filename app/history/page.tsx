"use client"

import { useState } from "react"
import { Button } from "@/components/ui/button"
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card"
import { Input } from "@/components/ui/input"
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select"
import { Badge } from "@/components/ui/badge"
import { ArrowLeft, Search, Filter, ArrowUpRight, ArrowDownLeft, Download, Calendar, CreditCard } from "lucide-react"
import Link from "next/link"

export default function HistoryPage() {
  const [searchTerm, setSearchTerm] = useState("")
  const [filterType, setFilterType] = useState("all")
  const [filterStatus, setFilterStatus] = useState("all")

  const transactions = [
    {
      id: "TXN001",
      type: "sent",
      recipient: "Kouame Jean",
      amount: 25000,
      date: "2024-01-15",
      time: "14:30",
      status: "completed",
      reference: "REF123456",
    },
    {
      id: "TXN002",
      type: "received",
      sender: "Aya Marie",
      amount: 15000,
      date: "2024-01-14",
      time: "09:15",
      status: "completed",
      reference: "REF123457",
    },
    {
      id: "TXN003",
      type: "sent",
      recipient: "Koffi Paul",
      amount: 50000,
      date: "2024-01-13",
      time: "16:45",
      status: "pending",
      reference: "REF123458",
    },
    {
      id: "TXN004",
      type: "topup",
      amount: 100000,
      date: "2024-01-12",
      time: "11:20",
      status: "completed",
      reference: "REF123459",
    },
    {
      id: "TXN005",
      type: "sent",
      recipient: "Fatou Diallo",
      amount: 30000,
      date: "2024-01-11",
      time: "13:10",
      status: "failed",
      reference: "REF123460",
    },
    {
      id: "TXN006",
      type: "payment",
      service: "CIE (Électricité)",
      amount: 15000,
      date: "2024-01-10",
      time: "10:30",
      status: "completed",
      reference: "REF123461",
    },
    {
      id: "TXN007",
      type: "payment",
      service: "SODECI (Eau)",
      amount: 8500,
      date: "2024-01-09",
      time: "14:20",
      status: "completed",
      reference: "REF123462",
    },
  ]

  const getTransactionIcon = (type: string) => {
    switch (type) {
      case "sent":
        return <ArrowUpRight className="h-5 w-5 text-red-600" />
      case "received":
        return <ArrowDownLeft className="h-5 w-5 text-green-600" />
      case "topup":
        return <Download className="h-5 w-5 text-blue-600" />
      case "payment":
        return <CreditCard className="h-5 w-5 text-purple-600" />
      default:
        return <ArrowUpRight className="h-5 w-5" />
    }
  }

  const getTransactionTitle = (transaction: any) => {
    switch (transaction.type) {
      case "sent":
        return `Envoyé à ${transaction.recipient}`
      case "received":
        return `Reçu de ${transaction.sender}`
      case "topup":
        return "Rechargement de compte"
      case "payment":
        return `Paiement ${transaction.service}`
      default:
        return "Transaction"
    }
  }

  const getStatusBadge = (status: string) => {
    switch (status) {
      case "completed":
        return <Badge className="bg-green-100 text-green-800">Terminé</Badge>
      case "pending":
        return <Badge variant="secondary">En cours</Badge>
      case "failed":
        return <Badge variant="destructive">Échoué</Badge>
      default:
        return <Badge variant="secondary">{status}</Badge>
    }
  }

  const filteredTransactions = transactions.filter((transaction) => {
    const matchesSearch =
      searchTerm === "" ||
      getTransactionTitle(transaction).toLowerCase().includes(searchTerm.toLowerCase()) ||
      transaction.reference.toLowerCase().includes(searchTerm.toLowerCase())

    const matchesType = filterType === "all" || transaction.type === filterType
    const matchesStatus = filterStatus === "all" || transaction.status === filterStatus

    return matchesSearch && matchesType && matchesStatus
  })

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Header */}
      <header className="bg-white shadow-sm border-b">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex items-center h-16">
            <Button variant="ghost" size="icon" asChild>
              <Link href="/dashboard">
                <ArrowLeft className="h-5 w-5" />
              </Link>
            </Button>
            <h1 className="ml-4 text-xl font-semibold text-gray-900">Historique des transactions</h1>
          </div>
        </div>
      </header>

      <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {/* Filters */}
        <Card className="mb-6">
          <CardHeader>
            <CardTitle className="flex items-center space-x-2">
              <Filter className="h-5 w-5" />
              <span>Filtres</span>
            </CardTitle>
          </CardHeader>
          <CardContent>
            <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div className="space-y-2">
                <label className="text-sm font-medium">Rechercher</label>
                <div className="relative">
                  <Search className="absolute left-3 top-3 h-4 w-4 text-gray-400" />
                  <Input
                    placeholder="Nom, référence..."
                    className="pl-10"
                    value={searchTerm}
                    onChange={(e) => setSearchTerm(e.target.value)}
                  />
                </div>
              </div>
              <div className="space-y-2">
                <label className="text-sm font-medium">Type</label>
                <Select value={filterType} onValueChange={setFilterType}>
                  <SelectTrigger>
                    <SelectValue />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="all">Tous les types</SelectItem>
                    <SelectItem value="sent">Envoyé</SelectItem>
                    <SelectItem value="received">Reçu</SelectItem>
                    <SelectItem value="topup">Rechargement</SelectItem>
                    <SelectItem value="payment">Paiement</SelectItem>
                  </SelectContent>
                </Select>
              </div>
              <div className="space-y-2">
                <label className="text-sm font-medium">Statut</label>
                <Select value={filterStatus} onValueChange={setFilterStatus}>
                  <SelectTrigger>
                    <SelectValue />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="all">Tous les statuts</SelectItem>
                    <SelectItem value="completed">Terminé</SelectItem>
                    <SelectItem value="pending">En cours</SelectItem>
                    <SelectItem value="failed">Échoué</SelectItem>
                  </SelectContent>
                </Select>
              </div>
            </div>
          </CardContent>
        </Card>

        {/* Transactions List */}
        <Card>
          <CardHeader>
            <div className="flex justify-between items-center">
              <CardTitle>Transactions ({filteredTransactions.length})</CardTitle>
              <Button variant="outline" size="sm">
                <Download className="h-4 w-4 mr-2" />
                Exporter
              </Button>
            </div>
          </CardHeader>
          <CardContent>
            <div className="space-y-4">
              {filteredTransactions.length === 0 ? (
                <div className="text-center py-8">
                  <p className="text-gray-500">Aucune transaction trouvée</p>
                </div>
              ) : (
                filteredTransactions.map((transaction) => (
                  <div
                    key={transaction.id}
                    className="flex items-center justify-between p-4 border rounded-lg hover:bg-gray-50 transition-colors"
                  >
                    <div className="flex items-center space-x-4">
                      <div className="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center">
                        {getTransactionIcon(transaction.type)}
                      </div>
                      <div>
                        <p className="font-medium">{getTransactionTitle(transaction)}</p>
                        <div className="flex items-center space-x-2 text-sm text-gray-500">
                          <Calendar className="h-3 w-3" />
                          <span>
                            {transaction.date} à {transaction.time}
                          </span>
                          <span>•</span>
                          <span>{transaction.reference}</span>
                        </div>
                      </div>
                    </div>
                    <div className="text-right">
                      <p
                        className={`font-semibold text-lg ${
                          transaction.type === "sent"
                            ? "text-red-600"
                            : transaction.type === "received"
                              ? "text-green-600"
                              : "text-blue-600"
                        }`}
                      >
                        {transaction.type === "sent" ? "-" : "+"}
                        {transaction.amount.toLocaleString()} FCFA
                      </p>
                      <div className="mt-1">{getStatusBadge(transaction.status)}</div>
                    </div>
                  </div>
                ))
              )}
            </div>
          </CardContent>
        </Card>
      </div>
    </div>
  )
}
